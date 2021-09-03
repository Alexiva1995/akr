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
            'Panel Principal' => [
                'submenu' => 0,
                'ruta' => route('home.user'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-grid',
                'complementoruta' => '',
            ],
            // Fin inicio

            // Mi Rango
            'Mi Rango' => [
                'submenu' => 1,
                'ruta' => '',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-zap',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Ver rangos',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('rangos'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Rango Actual',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('current-rank'),
                        'complementoruta' => ''
                    ],
            ],
        ],

            // Fin añadir saldo

            // Mis Referidos
            'Mis Referidos' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-users',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Arbol de referidos',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('genealogy_type', 'matriz'),
                        'complementoruta' => ''
                    ],

                    [
                        'name' => 'Lista De Referidos',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('genealogy_list_network', 'direct'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Comisiones',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('wallet.index'),
                        'complementoruta' => '',
                    ],

                ],
            ],
            // Fin De Mis Referidos

            // Paquetes de inversión
            'Depositos' => [
                'submenu' => 0,
                'ruta' => route('shop'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-briefcase',
                'complementoruta' => '',
            ],
            // Fin Paquetes de inversión


            // Negocio
            // 'Negocio' => [
            //     'submenu' => 1,
            //     'ruta' => 'javascript:;',
            //     'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //     'icon' => 'feather icon-users',
            //     'complementoruta' => '',
            //     'submenus' => [


            //         [
            //             'name' => 'Ordenes',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('reports.pedidos'),
            //             'complementoruta' => ''
            //         ],
            //         // [
            //         //     'name' => 'Referidos en Red',
            //         //     'blank'=> '', // si es para una pagina diferente del sistema solo coloquen _blank
            //         //     'ruta' => route('genealogy_list_network', 'network'),
            //         //     'complementoruta' => ''
            //         // ],
            //     ],
            // ],
            // Fin Negocio

            // 'Retiros' => [
            'Retiros' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-download-cloud',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Generar Retiro',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('retirar'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Historial de retiros',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('historial'),
                        // 'ruta' => route('retirar'),
                        'complementoruta' => ''
                    ],
                ],
            ],
            // Fin De Retiros

            // Soporte
            'Soporte' => [
                'submenu' => 0,
                'ruta' => route('ticket.list-user'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-headphones',
                'complementoruta' => '',
            ],
            // Fin Soporte

            // Perfil
            'Perfil' => [
                'submenu' => 0,
                'ruta' => route('profile'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-user',
                'complementoruta' => '',
            ],
            // Fin Perfil


            // Informes/Registros
            'Informes/Registros' => [
                'submenu' => 1,
                'ruta' => 'javascript:;',
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-clipboard',
                'complementoruta' => '',
                'submenus' => [
                    [
                        'name' => 'Registro de transacciones',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('transaction'),
                        'complementoruta' => ''
                    ],
                   
                    [
                        'name' => 'Registro de Retiros',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('retreats'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Registro de Inversión',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('invertion'),
                        'complementoruta' => ''
                    ],
                     [
                        'name' => 'Registro de Binario',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('binario'),
                        'complementoruta' => ''
                    ],
                ],
            ],

            // Fin Informes/Registros            

            // Historial de inicio de sesión
            'Historial inicio sesión' => [
                'submenu' => 0,
                'ruta' => route('logLogin'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-info',
                'complementoruta' => '',
            ],
            // Fin Historial de inicio de sesión            

            // Inverisones
            // 'Inversiones' => [
            //     'submenu' => 0,
            //     'ruta' =>  route('inversiones.index', 1),
            //     'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //     'icon' => 'feather icon-activity',
            //     'complementoruta' => '',

            // ],
            // Fin Inverisones

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
                        'name' => 'Arbol de referidos',
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
                'submenus' => [],
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
            // 'Informes' => [
            //     'submenu' => 1,
            //     'ruta' => 'javascript:;',
            //     'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //     'icon' => 'feather icon-file-text',
            //     'complementoruta' => '',
            //     'submenus' => [
            //         [
            //             'name' => 'Ordenes',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('reports.pedidos'),
            //             'complementoruta' => ''
            //         ],
            //         [
            //             'name' => 'Comisionesssss',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('reports.comision'),
            //             'complementoruta' => ''
            //         ],
            //         [
            //             'name' => 'Flujo de ganancia',
            //             'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
            //             'ruta' => route('flujo-de-ganancia'),
            //             'complementoruta' => ''
            //         ],
            //     ],
            // ],
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
                    [
                        'name' => 'Flujo de ganancia',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('flujo-de-ganancia'),
                        'complementoruta' => ''
                    ],

                ],
            ],
            // Fin Informes


            // Soporte
            'Soporte' => [
                'submenu' => 0,
                'ruta' => route('ticket.list-admin'),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-help-circle',
                'complementoruta' => '',
            ],
            // Fin Soporte


            //7- VTR
            'AKR' => [

                'submenu' => 1,
                'ruta' => (''),
                'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                'icon' => 'feather icon-dollar-sign',
                'complementoruta' => '',
                'submenus' => [],
                'submenus' => [
                    [
                        'name' => 'Generacion',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('Generacion'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Pendientes',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('Pendientes'),
                        'complementoruta' => ''
                    ],
                    [
                        'name' => 'Realizadas',
                        'blank' => '', // si es para una pagina diferente del sistema solo coloquen _blank
                        'ruta' => route('VTR.historys.status', 'Pagadas'),
                        'complementoruta' => ''
                    ]
                ],
            ],
        ];
    }
}
