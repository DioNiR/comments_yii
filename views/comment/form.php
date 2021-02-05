<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $commentForm \app\models\forms\CommentForm */

?>

<?php $form = ActiveForm::begin(["options" => ["class" => "form"]]); ?>
<?php echo $form->field($commentForm, "author_name")->textInput(["class" => "form-control", 'rows' => 3]); ?>
<?php echo $form->field($commentForm, "comment")->textarea(["class" => "form-control", 'rows' => 3]); ?>
<?php echo $form->field($commentForm, "parentId")->hiddenInput(['value' => $parentId])->label(false); ?>
<?php echo Html::submitButton(Yii::t('app', 'Отправить'), ["class" => "btn btn-default"]); ?>
<?php ActiveForm::end() ?>
