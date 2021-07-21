<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Menu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menu = null;
        if (Auth::check()) {
            $menu = $this->menuUsuario();
            if (Auth::user()->admin == 1) {
                $menu = $this->menuAdmin();
            }
        }
        View::share('menu', $menu);
        return $next($request);
    }

    /**
     * Permite Obtener el menu del usuario
     *
     * @return void
     */
    public function menuUsuario()
    {
        // $orden = app($OrdenService)->find($id);

        return [

            // Inicio
            'Dashboard' => [
                'submenu' => 0,
                'ruta' => route('home.user'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-home',
                'complementoruta' => '',
            ],
            // Fin inicio

            // // Añadir Saldo
            // 'Ecommerce' => [
            //     'submenu' => 0,
            //     'ruta' => route('shop'),
            //     'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
            //     'icon' => 'feather icon-shopping-cart',
            //     'complementoruta' => '',
            // ],
            // // Fin añadir saldo

            // Paquetes de inversión
            'Paquetes de inversión' => [
                'submenu' => 0,
                'ruta' => route('shop'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-package',
                'complementoruta' => '',
            ],
            // Fin Paquetes de inversión

            // Negocio
            'Negocio' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-users',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Arbol Binario',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('genealogy_type', 'tree'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Referidos Directos',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('genealogy_list_network', 'direct'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Ordenes',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => (''),
                        'complementoruta' => ''
                    ],
                    // [
                    //     'name' => 'Referidos en Red',
                    //     'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
                    //     'ruta' => route('genealogy_list_network', 'network'),
                    //     'complementoruta' => ''
                    // ],
                ],
            ],
            // Fin Negocio

            //U-4 Inverisones
            'Inversiones' => [
                'submenu' => 0,
                'ruta' =>  route('inversiones.index', 1),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-activity',
                'complementoruta' => '',
               
            ],
            // Fin Inverisones


            // Financiero
            'Financiero' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-dollar-sign',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Wallet',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('wallet.index'),
                        'complementoruta' => '',
                    ],
                    [
                        'name' => 'Retiros',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => '',
                        'complementoruta' => ''
                    ],
                    // [
                    //     'name' => 'Pagos',
                    //     'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
                    //     'ruta' => route('payments.index'),
                    //     'complementoruta' => ''
                    // ],

                    // [
                    //     'name' => 'Historial de Ordenes',
                    //     'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
                    //     'ruta' => route('shop.orden.history'),
                    //     'complementoruta' => '',
                    // ],
                ],
            ],

            // Fin Financiero


          
            // Soporte
            'Soporte' => [
                'submenu' => 0,
                'ruta' => route('ticket.list-user'),
                'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-help-circle',
                'complementoruta' => '',
            ],
            // Fin Soporte
        ];
    }


    public function menuAdmin()
    {
        return [
            //1-  Inicio
            'Dashboard' => [
                'submenu' => 0,
                'ruta' => route('home'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-home',
                'complementoruta' => '',
            ],
            // Fin inicio

            //Red
            'Red' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-users',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Usuarios',
                        'ruta' => route('users.list-user'),
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'icon' => 'fa fa-users',
                        'complementoruta' => '',
                    ],
                    [
                        'name' => 'Arbol Binario',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('genealogy_type', 'matriz'),
                        'complementoruta' => ''
                    ],
                ],
            ],
            //Fin de Red

            //3- inversiones
            'Inversiones' => [

                'submenu' => 0,
                'ruta' =>  route('inversiones.index', 1),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-shopping-cart',
                'complementoruta' => '',                
                'submenus' => [
                   
                ],                
                // 'submenus' => [
                //     [
                //         'name' => 'Grupos',
                //         'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                //         'ruta' => route('group.index'),
                //         'complementoruta' => ''
                //     ],
                //     [
                //         'name' => 'Paquetes',
                //         'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                //         'ruta' => route('package.index'),
                //         'complementoruta' => ''
                //     ],
                //     [
                //         'name' => 'Tienda',
                //         'blank' => '',  //si es para una pagina diferente del sistema solo coloquen _blank
                //         'ruta' => route('shop'),
                //         'complementoruta' => ''
                //     ],
                // ],
            ],
            
            // 4- Informes
            'Informes' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-file-text',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Ordenes',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('reports.pedidos'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Comisiones',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('reports.comision'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Billetera',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('wallet.index'),
                        'complementoruta' => ''
                    ],
                ],
            ],
            // Fin Informes

            //5- Liquidaciones
            'Liquidaciones' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'fa fa-list-alt',
                'complementoruta' => '',
                'submenus' => [

                    // [
                    //     'name' => 'Cierre Comisiones',
                    //     'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                    //     'ruta' => route('commission_closing.index'),
                    //     'complementoruta' => ''
                    // ],
                    [
                        'name' => 'Generacion',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('settlement'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Pendientes',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('settlement.pending'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Realizadas',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('settlement.history.status', 'Pagadas'),
                        'complementoruta' => ''
                    ]
                ],
            ],
            // Fin Liquidaciones            

            //Inversiones
            // 'Inversiones' => [
            //     'submenu' => 1,
            //     'ruta' => 'javascript:;',
            //     'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //     'icon' => 'feather icon-activity',
            //     'complementoruta' => '',
            //     'submenus' => [
            //         [
            //             'name' => 'Activas',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('inversiones.index', 1),
            //             'complementoruta' => ''
            //         ],
            //         [
            //             'name' => 'Culminadas',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('inversiones.index', 2),
            //             'complementoruta' => '',
            //         ],
            //     ],
            // ],
            // Fin Inverisones

            //  Fin Ecommerce
            //  Informes
            'Informes' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-file-text',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Ordenes',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('reports.pedidos'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Comisiones',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('reports.comision'),
                        'complementoruta' => ''
                    ],
                  
                ],
            ],
            // Fin Informes


             // Soporte
             'Soporte' => [
                'submenu' => 0,
                'ruta' => route('ticket.list-admin'),
                'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-help-circle',
                'complementoruta' => '',
            ],
            // Fin Soporte
        ];
    }
}
