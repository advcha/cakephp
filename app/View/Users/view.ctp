<!-- File: /app/View/Users/view.ctp -->
<h1><?php echo h($user['User']['username']); ?></h1>
<p><?php echo h($user['User']['role']); ?></p>
<p><small>Created: <?php echo $user['User']['created']; ?></small></p>
