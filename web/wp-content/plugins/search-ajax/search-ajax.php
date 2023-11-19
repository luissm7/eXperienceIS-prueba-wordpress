<?php

/**
 * Plugin Name:       Search Ajax
 * Description:       Plugin to search users with ajax
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Luis
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       search-ajax
 *
 * @package           search-ajax
 */

// If this file is called directly, then abort execution.
if (!defined('WPINC')) {
    die;
}

/**
 * Función para crear el cpt Usuarios
 *
 * @return void
 */
function cptui_register_my_cpts_usuarios()
{

    /**
     * Post Type: Usuarios.
     */

    $labels = [
        "name" => esc_html__("Usuarios", "twentytwentythree"),
        "singular_name" => esc_html__("Usuario", "twentytwentythree"),
        "menu_name" => esc_html__("Usuarios E", "twentytwentythree"),
        "all_items" => esc_html__("Todos los Usuarios", "twentytwentythree"),
        "add_new" => esc_html__("Añadir nuevo", "twentytwentythree"),
        "add_new_item" => esc_html__("Añadir nuevo Usuario", "twentytwentythree"),
        "edit_item" => esc_html__("Editar Usuario", "twentytwentythree"),
        "new_item" => esc_html__("Nuevo Usuario", "twentytwentythree"),
        "view_item" => esc_html__("Ver Usuario", "twentytwentythree"),
        "view_items" => esc_html__("Ver Usuarios", "twentytwentythree"),
        "search_items" => esc_html__("Buscar Usuarios", "twentytwentythree"),
        "not_found" => esc_html__("No se ha encontrado Usuarios", "twentytwentythree"),
        "not_found_in_trash" => esc_html__("No se han encontrado Usuarios en la papelera", "twentytwentythree"),
        "parent" => esc_html__("Usuario superior", "twentytwentythree"),
        "featured_image" => esc_html__("Imagen destacada para Usuario", "twentytwentythree"),
        "set_featured_image" => esc_html__("Establece una imagen destacada para Usuario", "twentytwentythree"),
        "remove_featured_image" => esc_html__("Eliminar la imagen destacada de Usuario", "twentytwentythree"),
        "use_featured_image" => esc_html__("Usar como imagen destacada de Usuario", "twentytwentythree"),
        "archives" => esc_html__("Archivos de Usuario", "twentytwentythree"),
        "insert_into_item" => esc_html__("Insertar en Usuario", "twentytwentythree"),
        "uploaded_to_this_item" => esc_html__("Subir a Usuario", "twentytwentythree"),
        "filter_items_list" => esc_html__("Filtrar la lista de Usuarios", "twentytwentythree"),
        "items_list_navigation" => esc_html__("Navegación de la lista de Usuarios", "twentytwentythree"),
        "items_list" => esc_html__("Lista de Usuarios", "twentytwentythree"),
        "attributes" => esc_html__("Atributos de Usuarios", "twentytwentythree"),
        "name_admin_bar" => esc_html__("Usuario", "twentytwentythree"),
        "item_published" => esc_html__("Usuario publicado", "twentytwentythree"),
        "item_published_privately" => esc_html__("Usuario publicado como privado.", "twentytwentythree"),
        "item_reverted_to_draft" => esc_html__("Usuario devuelto a borrador.", "twentytwentythree"),
        "item_scheduled" => esc_html__("Usuario programado", "twentytwentythree"),
        "item_updated" => esc_html__("Usuario actualizado.", "twentytwentythree"),
        "parent_item_colon" => esc_html__("Usuario superior", "twentytwentythree"),
    ];

    $args = [
        "label" => esc_html__("Usuarios", "twentytwentythree"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "usuarios",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => ["slug" => "usuarios", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-users",
        "supports" => ["title", "custom-fields"],
        "show_in_graphql" => false,
    ];

    register_post_type("usuarios", $args);
}
add_action('init', 'cptui_register_my_cpts_usuarios');


/**
 * Añadimos al post type usuarios 3 campos adicionales
 */
add_filter('rwmb_meta_boxes', function ($meta_boxes) {
    $meta_boxes[] = [
        'title'   => esc_html__('User data', 'online-generator'),
        'id'      => 'userData',
        'post_types' => 'usuarios',
        'context' => 'normal',
        'fields'  => [
            [
                'type' => 'text',
                'name' => esc_html__('Name', 'online-generator'),
                'id'   => 'name',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Surname 1', 'online-generator'),
                'id'   => 'surname1',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Surname 2', 'online-generator'),
                'id'   => 'surname2',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Email', 'online-generator'),
                'id'   => 'email',
            ],
        ],
    ];

    return $meta_boxes;
});

/**
 * Rest api POST para añadir usuarios
 */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/add_users', [
        'methods' => 'POST',
        'callback' => 'add_users'
    ]);
});

/**
 * Función para añadir usuarios a traves desde el JSON al endpoint (No lo he podido probar porque en mi local no me funciona)
 *
 * @return void
 */
function enviar_datos_desde_json_al_endpoint()
{
    $file = plugin_dir_path(__FILE__) . 'includes/json/data.json';

    if (file_exists($file)) {
        $json_data = file_get_contents($file);
    } else {
        echo 'El archivo data.json existe.';
    }

    if ($json_data !== false) {
        $data = json_decode($json_data, true);

        if (isset($data['usuarios']) && is_array($data['usuarios'])) {
            $usuarios = $data['usuarios'];

            $endpoint_url = 'http://experienceprueba.docker.localhost/wp-json/wp/v2/add_users';

            $login = 'admin';
            $password = 'admin';

            foreach ($data['usuarios'] as $usuario) {
                $response = wp_remote_post($endpoint_url, array(
                    'method' => 'POST',
                    'body' => $usuario,
                    'headers' => array(
                        'Content-Type' => 'application/json; charset=UTF-8',
                    )
                ));

                if (is_wp_error($response)) {
                    $error_message = $response->get_error_message();
                    echo "Error: $error_message";
                } else {
                    $response_body = wp_remote_retrieve_body($response);
                    echo "Respuesta del servidor: $response_body";
                }
            }
        } else {
            echo "La estructura del JSON no es la esperada";
        }
    } else {
        echo "No se pudo leer el archivo JSON";
    }
}
// enviar_datos_desde_json_al_endpoint();

/**
 * Función callback del endpoint
 *
 * @param [type] $data
 * @return void
 */
function add_users($data)
{
    $datos = $data->get_body();

    if (isset($datos)) {
        $usuarios = json_decode($datos, true);
    } else {
        echo 'No se han introducido datos';
    }

    if (isset($usuarios['usuarios']) && is_array($usuarios['usuarios'])) {
        foreach ($usuarios['usuarios'] as $usuario) {

            $my_post = array(
                'post_title' => $usuario['id'],
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type' => 'usuarios',
                'meta_input' => array(
                    'name' => "$usuario[name]",
                    'surname1' => "$usuario[surname1]",
                    'surname2' => "$usuario[surname2]",
                    'email' => "$usuario[email]",
                )
            );
            $idPost = wp_insert_post($my_post);

            if ($idPost != 0) {
                echo "Usuario añadido";
            } else {
                echo "Usuario no añadido";
            }
        }
    }
}

/**
 * Función para mostrar el shortcode con la tabla
 *
 * @return void
 */
function wp_shortcode()
{
    $message = '';

    $message .= '<form id="search-form">';
    $message .= '<div class="input-wrapper">';
    $message .= '<input type="text" id="name-search-input" name="name" placeholder="Nombre...">';
    $message .= '</div>';
    $message .= '<div class="input-wrapper">';
    $message .= '<input type="text" id="surname-search-input" name="surname" placeholder="Apellido...">';
    $message .= '</div>';
    $message .= '<div class="input-wrapper">';
    $message .= '<input type="text" id="email-search-input" name="email" placeholder="Email...">';
    $message .= '</div>';
    $message .= '<div class="button-wrapper">';
    $message .= '<input type="submit" value="Buscar">';
    $message .= '</div>';
    $message .= '</form>';

    $message .= '<div id="search-results">';
    $message .= create_table($args = array(
        'posts_per_page' => 5,
        'post_type' => 'usuarios',
    ));
    $message .= '</div>';

    $message .= '<div class="pagination">';
    $message .= '<button id="prevPage" disabled>Anterior</button>';
    $message .= '<span id="currentPage">Página 1</span>';
    $message .= '<button id="nextPage">Siguiente</button>';
    $message .= '</div>';

    return $message;
}
add_shortcode('table_users', 'wp_shortcode');

/**
 * Añadir script AJAX en WordPress
 *
 * @return void
 */
function add_script_ajax()
{
    wp_enqueue_script('custom-ajax-script', plugins_url('/', __FILE__) . '/includes/assets/js/ajax.js', array('jquery'), true);
    wp_enqueue_style('custom-styles', plugins_url('/includes/assets/css/styles.css', __FILE__), true);
    wp_localize_script('custom-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_script_ajax');

/**
 * Función para procesar la solicitud AJAX de búsqueda
 *
 * @return void
 */
function buscar_resultados()
{
    $name_search_term = $_POST['name'];
    $email_search_term = $_POST['email'];
    $surname_search_term = $_POST['surname'];
    $page = $_POST['pagina'];

    $args = array(
        'posts_per_page' => 5,
        'paged' => $page,
        'post_type' => 'usuarios',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'name',
                'value' => $name_search_term,
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'email',
                'value' => $email_search_term,
                'compare' => 'LIKE',
            ),
            array(
                'relation' => 'OR',
                array(
                    'key' => 'surname1',
                    'value' => $surname_search_term,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'surname2',
                    'value' => $surname_search_term,
                    'compare' => 'LIKE',
                ),
                'concat_clause' => "CONCAT_WS(' ', meta1.meta_value, meta2.meta_value) LIKE '%" . $surname_search_term . "%'",
            ),
        )
    );

    echo create_table($args);

    wp_die();
}
add_action('wp_ajax_buscar_resultados', 'buscar_resultados');
add_action('wp_ajax_nopriv_buscar_resultados', 'buscar_resultados');



/**
 * Función para crear la tabla
 *
 * @param [type] $args
 * @return void
 */
function create_table($args)
{
    $html = '';

    $query = new WP_Query($args);

    $data = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $data[] = [
                'Nombre' => get_post_meta(get_the_ID(), 'name', true),
                'Apellidos' => get_post_meta(get_the_ID(), 'surname1', true) . ' ' . get_post_meta(get_the_ID(), 'surname2', true),
                'Email' => get_post_meta(get_the_ID(), 'email', true),
            ];
        }
        wp_reset_postdata(); // Restablece los datos del post
    } else {
        return 'No se encontraron usuarios.';
    }

    $html .= '<table id="users">';
    $html .= '<thead>';

    if (sizeof($data) > 0) {
        $html .= '<tr>';

        foreach ($data[0] as $label => $val) {
            $html .= '<th>' . $label . '</th>';
        }

        $html .= '</tr>';
    }

    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($data as $item) {
        $item = (array)$item;

        $html .= '<tr>';

        foreach ($item as $label => $val) {
            $html .= '<td>' . $val . '</td>';
        }

        $html .= '<tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
}
