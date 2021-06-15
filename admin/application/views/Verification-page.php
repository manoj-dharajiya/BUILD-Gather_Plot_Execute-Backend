<?php 
require_once('header.php');
?>
    <div class="container">
        <?php
        if(isset($message) && $message != "") { 
            $type = ($message['type'] == 'error')?"danger":$message['type'];
            ?>
            <div class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?php echo $message['message']; ?>
            </div>
        <?php                    
        } ?>

        <div class="heading verification-page">
            <?php if(isset($message) && $message['type'] == 'success') { ?>
                <h1>Verification Successful!</h1>
                <p>You will receive a response from us within 5-7 business days.</p>
                <p>Continue Searching For Black Businesses</p>
                <p><a href="<?php echo base_url();?>" class="btn btn-primary">Home</a></p>

            <?php } else {
                ?>
                <h1>Verification Unsuccessful!</h1>
                <p>Continue Searching For Black Businesses</p>
                <p><a href="<?php echo base_url();?>" class="btn btn-primary">Home</a></p>
                <?php
            } ?>
        </div>

    </div>
<?php
require_once('footer.php');
