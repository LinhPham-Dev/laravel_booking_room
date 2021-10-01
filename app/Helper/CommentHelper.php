<?php
if (!function_exists('showComments')) {
    function showComments($comments, $parent_id = 0, $child_class = '')
    {
        foreach ($comments as $key => $comment) {

            // Check child_comment
            if ($comment->parent_id == $parent_id) {

                if ($comment->parent_id != 0) {
                    echo '<ul class="' . $child_class .  'comment-list mb-4">';
                } else {
                    echo '<ul class="comment-list mb-4">';
                }

                echo '<li>
                    <div class="comment-author">
                        <img src="assets/img/blog-details/04.jpg" alt="Avatar">
                    </div>
                    <div class="comment-desc">
                        <h6 id="comment-' . $comment->id . '">' . $comment->user->name . '<span class="comment-date ml-3">' . dateBlog($comment->created_at) . '</span>
                        </h6>';
                if ($comment->parent_id != 0) {
                    echo '<p class="reply-to">Reply to: <a href="#comment-' . $comment->parentComment->id . '">' . $comment->parentComment->user->name . '</a></p>';
                }
                echo '<p>' . $comment->message . '</p>
                        <a class="reply-comment" data-toggle="collapse" href="#reply-' . $comment->id . '" role="button"
                            aria-expanded="false" aria-controls="reply">
                            Reply <i class="far fa-long-arrow-right"></i>
                        </a>
                        <div class="collapse" id="reply-' . $comment->id . '">
                            <form action="/blogs/comment" method="POST">
                                ' . csrf_field() . '
                                <input type="hidden" name="parent_id" value=' . $comment->id . '>
                                <input type="hidden" name="blog_id" value=' . $comment->blog->id . '>
                                <div class="input-wrap text-area">
                                    <textarea placeholder="Write Review" name="message"></textarea>
                                    <i class="far fa-pencil"></i>
                                </div>
                                <div class="input-wrap">
                                    <button type="submit"
                                        class="btn btn-block btn-submit-reply">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>';
                // Unset this item
                unset($comments[$key]);

                showComments($comments, $comment->id, $child_class = 'children ');

                echo '</li></ul>';
            }
        }
    }
}
