<?
if (isset($comment))
{
$result_comment = mysql_query ("SELECT comment.id, comment.data FROM comment WHERE comment.id = $comment", $db);
verification_query_2($result_comment);
$result_comment = mysql_fetch_array($result_comment);
}
?>
<div class="composition__info composition__comment">
  <?php echo $result_comment['data']; ?>
</div>