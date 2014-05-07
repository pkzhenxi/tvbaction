<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v_id')); ?>:</b>
	<?php echo CHtml::encode($data->v_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeid')); ?>:</b>
	<?php echo CHtml::encode($data->typeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ischeck')); ?>:</b>
	<?php echo CHtml::encode($data->ischeck); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dtime')); ?>:</b>
	<?php echo CHtml::encode($data->dtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg')); ?>:</b>
	<?php echo CHtml::encode($data->msg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_type')); ?>:</b>
	<?php echo CHtml::encode($data->m_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reply')); ?>:</b>
	<?php echo CHtml::encode($data->reply); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agree')); ?>:</b>
	<?php echo CHtml::encode($data->agree); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anti')); ?>:</b>
	<?php echo CHtml::encode($data->anti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
	<?php echo CHtml::encode($data->pic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote')); ?>:</b>
	<?php echo CHtml::encode($data->vote); ?>
	<br />

	*/ ?>

</div>