<?php
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;
use yii\helpers\Url;
use dosamigos\tinymce\TinyMce;
use yii\widgets\ActiveForm;
?>
<h2>内容</h2>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
  <?php ActiveForm::end(); ?>
<hr />
<h2>qrcode</h2>
<h2><img src="<?= Url::to(['route/qrcode'])?>" /></h2>
<?php
	$mailTo = new MailTo(['email' => 'email@example.com']);
	echo $mailTo->getText();
	die;
		return QrCode::png($mailTo->getText());
?>