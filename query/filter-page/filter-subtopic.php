<?php
include_once('../../database/config.php');

?>
<?php
$subtopic =   mysqli_real_escape_string($mysqli, $_POST['module']);

$subTopicQuery = $mysqli->prepare("SELECT * FROM subtopic_tbl WHERE module = ?");
$subTopicQuery->bind_param('s', $subtopic);
$subTopicQuery->execute();
$resultSubtopic = $subTopicQuery->get_result();
$count = 1;

while ($returnSubTopic = $resultSubtopic->fetch_assoc()) { ?>
    <a class="media-list-item" data-id="<?php echo $returnSubTopic['subtopic_id'] ?>" data-module="<?php echo $returnSubTopic['module'] ?>" target="<?php echo $returnSubTopic['subtopic_id'] ?>" id="page-<?php echo $returnSubTopic['subtopic_id'] ?>"><?php echo $count++ ?>. <?php echo $returnSubTopic['subtopic'] ?></a>

<?php } ?>