<div id=”comment-list-box”> 
<?php if(!empty($comments)) { foreach($comments as $k=>$v) { ?>

// display comments list 
<div class=”message-box” id=”message_<?php echo $comments[$k][“id”];?>”> 
<div> 
<button class=”btnEditAction” name=”edit” onClick=”showEditBox(<?php echo $comments[$k][“id”]; ?>)”>Edit</button> 
<button class=”btnDeleteAction” name=”delete” onClick=”callCrudAction(‘delete’,<?php echo $comments[$k][“id”]; ?>)”>Delete</button> 
</div> 
<div class=”message-content”><?php echo $comments[$k][“message”]; ?></div> 
</div> <?php }} ?> </div> 
<div id=”frmAdd”><textarea name=”txtmessage” id=”txtmessage” cols=”80″ rows=”10″>
</textarea> <p><button id=”btnAddAction” name=”submit” onClick=”callCrudAction(‘add’,”)”>Add Comment</button></p> 
</div>