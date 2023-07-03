<?php 

function photo_data($post){
  $post_meta = get_post_meta($post->ID);
  $src = wp_get_attachment_image_src($post_meta['img'][0],'large'[0]);
}

function api_photo_get($request){
  $post_id = $request['id'];
  $post = get_post($post_id);

  if(!isset($post) || empty($post_id)){
    $response = new WP_Error('error', 'Post não encontrado', ['status'  =>  404]);
    return rest_ensure_response($response);
  }

 // $comments = get_comments([
   // 'post_id' => $post_id,
  //]);
    return rest_ensure_response($post);
  }

function register_api_photo_get(){
  register_rest_route('v1','/comment/(?P<id>[0-9]+)', [
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'api_photo_get',
  ]);
}
  add_action('rest_api_init', 'register_api_photo_get');
?>