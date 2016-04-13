<?php
namespace Psg;

class ViewHelpers {

    public static function makeNiceDate($dateIn)
    {
        $dateOut = date("F d, Y G:i", strtotime($dateIn));
        return $dateOut;
    }

    public static function renderLikeIcon($user,$message)
    {
	    $isLikedByMe = \Cl\MessageManager::haveILiked($user,$message);
	    $shadeClass = \Cl\MessageManager::getShadeClass($message);

        $route = $isLikedByMe ? 'site.messagelikes.remove' : 'site.messagelikes.add';
        $title = $isLikedByMe ? 'Unlike' : 'Like';
        $params = $isLikedByMe ?  [$message->id] : null;
        $content =  '<div title="'.$title.'" message_id="'.$message->id.'" class="fa fa-heart tag-label '.$shadeClass.'"></div>';
        $content .= '<div data_post-id="'.$message->id.'" class="tag-number" title="'.$message->getLikeCount().' Like(s)">'.$message->getLikeCount().'</div>';

        $html = '<span class="tag-like_icon tag-icon">';
        $classes[] = $isLikedByMe ? 'tag-clickme_to_remove_like' : 'tag-clickme_to_add_like';
        $html .= html_entity_decode( 
                                    link_to_route( $route, $content, $params, ['data-message_id'=>$message->id,'class'=>implode(' ',$classes)] ) 
                                );
        $html .= '</span>';
        return $html;
    } // renderLikeIcon()

    // for Messages
    public static function renderDeleteIcon($user,$message)
    {
        $content =  '<span title="Remove Post" message_id="'.$message->id.'" class="fa fa-remove tag-label"></span>';

        $html = '<span class="tag-remove_icon tag-icon">';
        $classes = [];
        $params = $message->id;
        $attrs = [
                    'class'=>implode(' ',$classes),
                    'data-message_id'=>$message->id,
                    'data-method'=>'DELETE',
                    'data-confirm'=>'Are you sure you want to delete this post?',
                 ];
        $html .= html_entity_decode( link_to_route('site.messages.destroy',$content,$params,$attrs) );
        $html .= '</span>';
        return $html;
    } // renderDeleteIcon()

    // for Messages
    public static function renderNotificationDeleteIcon($user,$notification)
    {
        $content =  '<span title="Remove Notification" notification_id="'.$notification->id.'" class="fa fa-remove tag-label"></span>';

        $html = '<span class="tag-remove_icon tag-icon">';
        $classes = [];
        $params = $notification->id;
        $attrs = [
                    'class'=>implode(' ',$classes),
                    'data-notification_id'=>$notification->id,
                    'data-method'=>'DELETE',
                    'data-confirm'=>'Are you sure you want to delete this notification?',
                 ];
        $html .= html_entity_decode( link_to_route('site.notifications.destroy',$content,$params,$attrs) );
        $html .= '</span>';
        return $html;
    } // renderNotificationDeleteIcon()

}
