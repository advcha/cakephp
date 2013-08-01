<!-- File: /app/View/Users/index.ctp -->
<h1>Blog users</h1>
<?php 
	echo $this->Html->link('Add User',array('controller' => 'users', 'action' => 'add')); 
?>
<br/>
<table>
	<tr>
		<th>Id</th>
		<th>Username</th>
		<th>Role</th>
		<th>Action</th>
		<th>Created</th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['id']; ?></td>
		<td>
		<?php echo $this->Html->link($user['User']['username'],
		array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
		</td>
		<td>
		<?php echo $user['User']['role']; ?>
		</td>
		<td>
		<?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
		<?php echo $this->Form->postLink('Delete',array('action' => 'delete', $user['User']['id']),array('confirm' => 'Are you sure?'));
?>
		</td>
		<td><?php echo $user['User']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($user); ?>
</table>