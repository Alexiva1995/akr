<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\OrdenPurchases;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ActivacionController;
use App\Http\Controllers\TiendaController;
use App\Models\Inversion;
use App\Models\Liquidaction;
use App\Models\LogLogin;
use App\Models\RankRecord;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public $reportController;
    public $treeController;
    public $activacionController;
    public $servicioController;
    public $addsaldoController;
    public $walletController;
    public $tiendaController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->tiendaController = new TiendaController();
        $this->treeController = new TreeController;
        $this->reportController = new ReporteController();
        $this->walletController = new WalletController;
        $this->activacionController = new ActivacionController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function index()
    {
        try {
            View::share('titleg', '');
            // $this->activacionController->activarUser();
            // $this->activacionController->deleteUser();
            // $this->tiendaController->getOrdenes();
            $data = $this->dataDashboard(Auth::id());
            return view('dashboard.index', compact('data'));
        } catch (\Throwable $th) {
            Log::error('Home - index -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function indexUser()
    {

        try {
            View::share('titleg', '');
            $data = $this->dataDashboard(Auth::id());
            return view('dashboard.indexUser', compact('data'));
        } catch (\Throwable $th) {
            Log::error('Home - indexUser -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite obtener la informacion a mostrar en el dashboard
     *
     * @param integer $iduser
     * @return array
     */
    public function dataDashboard(int $iduser):array
    {
        $mes = Carbon::now();
        $mes = $mes->format('m');
        // dd($mes-1);
        $currentMonthRef = User::where('referred_id', Auth::id())->whereMonth('created_at',$mes)->count();
        $lastMonthRef = User::where('referred_id', Auth::id())->whereMonth('created_at',$mes-1)->count();

        $inversionLast = Inversion::where('iduser', '=', Auth::id())->orderBy('id', 'desc')->first();
        $montoInversion = 0;
        $porcentajeInversion = 0;
        if ($inversionLast != null) {
            $montoInversion = $inversionLast->invertido;
            $porcentajeInversion = (($inversionLast->ganacia / ($montoInversion * 1)) * 100);
        }

        $iduser = Auth::user()->id;
        $rango = RankRecord::where('iduser', $iduser)->first();         
        $rango_actual = $rango != null ? $rango->rank->name : "NO HA OBTENIDO UN RANGO AÚN";

        $data = [
            'id' => Auth::user()->id,
            'actuales' => $currentMonthRef,
            'pasados' => $lastMonthRef,
            'wallet' => Auth::user()->getWallet->where('status', 0)->sum('monto'),
            'crypto' => Auth::user()->getCrypto->where('status', 0)->sum('cantidad'),
            'comisiones' => Auth::user()->getWallet->sum('monto'),
            'tickets' => 0,
            'ordenes' => $this->reportController->getOrdenes(10),
            'usuario' => Auth::user()->fullname,
            'rewards' => Wallet::where([['iduser', '=', $iduser], ['status', '=', '0']])->get()->sum('monto'),
            'packages' => OrdenPurchases::where([['iduser', '=', $iduser]])->get(),
            'inversion' => $montoInversion,
            'porcentaje' => $porcentajeInversion,
            'rango_actual' => $rango_actual,
        ];

        return $data;
    }

    /**
     * Permite actualizar el lado a registrar de un usuario
     *
     * @param string $side
     * @return void
     */
    public function updateSideBinary($side): string
    {
        try {
            DB::table('users')->where('id', Auth::id())->update(['binary_side_register' => $side]);
            return json_encode('bien');
        } catch (\Throwable $th) {
            Log::error('Home - indexUser -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite obtener la informacion para las graficas del dashboard
     *
     * @return string
     */
    public function getDataGraphic(): string
    {
        try {
            $iduser = Auth::id();
            $data = [
                'comisiones' => $this->walletController->getDataGraphiComisiones($iduser),
                'tickets' => [],
                'saldo' => [],
                'ordenes' => []
            ];
            
            return json_encode($data);
        } catch (\Throwable $th) {
            Log::error('Home - getDataGraphic -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Lleva a la vista de terminos y condiciones
     *
     * @return void
     */
    public function terminosCondiciones()
    {
        View::share('titleg', 'Terminos y Condiciones');
        return view('terminos_condiciones.index');
    }
    public function dataGrafica()
    {
        $anno = Carbon::now()->format('Y');
        $fecha_ini = Carbon::createFromDate($anno,1,1)->startOfDay();
        $fecha_fin = Carbon::createFromDate($anno, 12,1)->endOfMonth()->endOfDay();

        $ordenes = Wallet::where('iduser', Auth::id())->where('status', '1')
                    ->select(
                        
                        DB::raw('date_format(created_at,"%m/%Y") as created'),
                        DB::raw('SUM(monto) as montos'),
                    )
                    ->whereBetween('created_at', [$fecha_ini, $fecha_fin])
                    ->groupBy('created')
                    ->get()
                    ->toArray();
        $valores = [];
      
        for ( $date = $fecha_ini->copy(); $date->lt( $fecha_fin) ; $date->addMonth(1) ) {

            $valores[$date->format('m/Y')] = 0;
     
        }
        
        foreach($ordenes as $key => $orden){
            $valores[$orden['created']] = $orden['montos'];
        }
        //arreglado
        $data = [];
        foreach($valores as $valor){
            $data[] = floatVal($valor);
        }
     
        return response()->json(['valores' => $data]);
    }

    public function logLogin()
    {
        if(Auth::user()->admin == 1){
            $logins = LogLogin::all();
        }else{
            $logins = LogLogin::where('iduser', Auth::user()->id)->get();
        }

        return view('logLogin.index', compact('logins'));        
    }

    public function getRealIP() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{

            return $_SERVER["REMOTE_ADDR"];

        }

    }

    public function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if(strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return 'Microsoft Edge';
        elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return 'Internet explorer';
        elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return "Opera";
        elseif(strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($user_agent, 'Safari') !== FALSE)
            return "Safari";
        else
            return 'No hemos podido detectar su navegador';

    }

    public function getPlatform() 
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $plataformas = array(
           'Windows 10' => 'Windows NT 10.0+',
           'Windows 8.1' => 'Windows NT 6.3+',
           'Windows 8' => 'Windows NT 6.2+',
           'Windows 7' => 'Windows NT 6.1+',
           'Windows Vista' => 'Windows NT 6.0+',
           'Windows XP' => 'Windows NT 5.1+',
           'Windows 2003' => 'Windows NT 5.2+',
           'Windows' => 'Windows otros',
           'iPhone' => 'iPhone',
           'iPad' => 'iPad',
           'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
           'Mac otros' => 'Macintosh',
           'Android' => 'Android',
           'BlackBerry' => 'BlackBerry',
           'Linux' => 'Linux',
        );
        foreach($plataformas as $plataforma=>$pattern){
           if (preg_match('/(?i)'.$pattern.'/', $user_agent))
              return $plataforma;
        }
        return 'Otras';
    }

    public function getLocation(){
        $user = Auth::user();
        $country = $user->country->sortname;
        $state = $user->state;
        $city = $user->city;
        
        $location = $city.' - '. $state.' - '.$country;

        return $location;
    }
    
}
