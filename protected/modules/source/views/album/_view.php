<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vid')); ?>:</b>
	<?php echo CHtml::encode($data->vid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artist')); ?>:</b>
	<?php echo CHtml::encode($data->artist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('introduction')); ?>:</b>
	<?php echo CHtml::encode($data->introduction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pubtime')); ?>:</b>
	<?php echo CHtml::encode($data->pubtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommend')); ?>:</b>
	<?php echo CHtml::encode($data->recommend); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hit')); ?>:</b>
	<?php echo CHtml::encode($data->hit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('good')); ?>:</b>
	<?php echo CHtml::encode($data->good); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check')); ?>:</b>
	<?php echo CHtml::encode($data->check); ?>
	<br />

	*/ ?>

</div>