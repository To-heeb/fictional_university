<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

function universityLikeRoutes()
{

    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'POST',
        'callback' => 'createLike',
    ]);

    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'DELETE',
        'callback' => 'deleteLike',
    ]);
}
add_action('rest_api_init', 'universityLikeRoutes');


function createLike($data)
{
    if (is_user_logged_in()) {
        $professorId = sanitize_text_field($data['professorId']);

        $existQuery = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => [
                [
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professorId,
                ]
            ],
        ]);

        if ($existQuery->found_posts == 0 and get_post_type($professorId) == 'professor') {
            // create new like post
            return wp_insert_post([
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => 'Liked Post',
                'meta_input' => [
                    'liked_professor_id' => $professorId
                ]
            ]);
        } else {
            die("Already Like professor or post type not for professor");
        }
    } else {
        die("Only logged in user can create like");
    }
}

function deleteLike($data)
{
    $likeId = sanitize_text_field($data['likeId']);

    // return get_current_user_id() . " " . get_post_field('post_author', $likeId) . " " . get_post_type($likeId);
    // exit();
    if (get_current_user_id() == get_post_field('post_author', $likeId) and get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);

        return "Congrat like deleted";
    } else {
        die("You do not have permission to delete that");
    }
}
