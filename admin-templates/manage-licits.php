<?php 
// Check that the user is allowed to update options
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}
global $wpdb;

if (isset($_POST['approve-pending-request'])){
	$req_id = (int) $_POST['request_id'];
	$licit = $wpdb->update( 'licits', array( 'active' => true ), array( 'ID' => $req_id ), array( '%d' ), array( '%d' ) );
}

?>
<style>
	.licit-requests table{
		width: 100%;
		padding: 10px;
		border-collapse: collapse;
		border: 2px solid #888;
	}
	
	.licit-requests table thead th{
		background: #888;
		color: #eee;
		padding: 10px;
	}
	
	.licit-requests table tbody td{
		color: #333;
		text-align: center;
		padding: 10px;
	}	
	
	.licit-requests table tbody tr:nth-child(even) td{	
		background: #ccc;
	}
	
	input.approve-pending-request{
		padding: 5px 10px;
		display: block;
		background: rgb(0, 197, 0);
		border: none;
		color: white;
		text-transform: uppercase;
		margin: 0;
		width: 100%;	
		font-weight: 600;
		box-shadow: 1px 0px 3px 0px black;
		-webkit-transition: all .1s ease-in-out;
		-moz-transition: all .1s ease-in-out;
		-o-transition: all .1s ease-in-out;
		transition: all .1s ease-in-out;		
	}
	
	input.approve-pending-request:hover{
		background: white;
		color: rgb(0, 197, 0);
		cursor: pointer;
		
	}	
</style>
<div class="wrap">
	<h2><?php _e('Licitek kezelése', 'palotaholding')?></h2>
	<?php $pending_requests = $wpdb->get_results("SELECT * FROM licits WHERE active = 0");?>
	<?php if (!empty($pending_requests)):?>	
		<div class="pending licit-requests">
			<h3><?php _e('Függőben lévő felkérések', 'palotaholding')?></h3>
			<table>
				<thead>
					<tr>
						<th><?php _e('Kérelem azonosító', 'palotaholding')?></th>
						<th><?php _e('Felhasználó azonosító', 'palotaholding')?></th>
						<th><?php _e('Felhasználó név', 'palotaholding')?></th>
						<th><?php _e('Email', 'palotaholding')?></th>
						<th><?php _e('Lakás azonosító', 'palotaholding')?></th>
						<th><?php _e('Kérelem időpontja', 'palotaholding')?></th>
						<th><?php _e('Műveletek', 'palotaholding')?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pending_requests as $pr):?>
						<?php $user = get_userdata( $pr->user_ID );?>
						<tr>
							<td><?php echo $pr->ID?></td>
							<td><?php echo $pr->user_ID?></td>
							<td><?php echo $user->display_name?></td>
							<td><?php echo $user->user_email?></td>
							<td><?php echo $pr->flat_ID?></td>
							<td><?php echo $pr->date?></td>
							<td>
								<form method="post">
									<input type="hidden" name="request_id" value="<?php echo $pr->ID?>"/>
									<input type="submit" name="approve-pending-request" class="approve-pending-request" value="<?php _e('Elfogad', 'palotaholding')?>" />
								</form>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	<?php endif;?>

	<?php $accepted_requests = $wpdb->get_results("SELECT * FROM licits WHERE active = 1");?>
	<?php if (!empty($accepted_requests)):?>	
		<div class="accepted licit-requests">
			<h3><?php _e('Elfogadott felkérések', 'palotaholding')?></h3>
			<table>
				<thead>
					<tr>
						<th><?php _e('Kérelem azonosító', 'palotaholding')?></th>
						<th><?php _e('Felhasználó azonosító', 'palotaholding')?></th>
						<th><?php _e('Felhasználó név', 'palotaholding')?></th>
						<th><?php _e('Email', 'palotaholding')?></th>
						<th><?php _e('Lakás azonosító', 'palotaholding')?></th>
						<th><?php _e('Kérelem időpontja', 'palotaholding')?></th>
						<th><?php _e('Műveletek', 'palotaholding')?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($accepted_requests as $pr):?>
						<?php $user = get_userdata( $pr->user_ID );?>
						<tr>
							<td><?php echo $pr->ID?></td>
							<td><?php echo $pr->user_ID?></td>
							<td><?php echo $user->display_name?></td>
							<td><?php echo $user->user_email?></td>
							<td><?php echo $pr->flat_ID?></td>
							<td><?php echo $pr->date?></td>
							<td>
								<form method="post">
									<input type="hidden" name="request_id" value="<?php echo $pr->ID?>"/>
								</form>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	<?php endif;?>	
</div>