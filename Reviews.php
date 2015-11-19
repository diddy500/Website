<!-- Bootstrap modal review menu based of http://www.w3schools.com/bootstrap/bootstrap_modal.asp -->
<div class="modal fade" id="reviewModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reviews</h4>
            </div>
            <div class="modal-body" id="previously_submitted_comments">
                
            </div>
            <div class="modal-body">
            <?php
            if (isset($_SESSION['user'])) {
                echo '
            
                
                    <form id="reviewForm" name="reviewForm" role="form" onsubmit="return frmComment_submit();">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="' . $results[0] . ' ' . substr($results[1], 0, 1) . '";>
                    </div>
                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea class="form-control" rows="5" id="review" name="review"></textarea>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="optRating" value="1"><img src="Images/stars_rating_01.gif" alt=""></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="optRating" value="2"><img src="Images/stars_rating_02.gif" alt=""></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="optRating" value="3"><img src="Images/stars_rating_03.gif" alt=""></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="optRating" value="4"><img src="Images/stars_rating_04.gif" alt=""></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="optRating" value="5" checked ><img src="Images/stars_rating_05.gif" alt=""></label>
                    </div>
                    <input type="hidden" id="prodCode" name="prodCode">
                    <input type="submit" class="btn btn-default" value="Submit">
                    </form>';
            }
            else {
                echo 'Please sign in to comment.';
            }
            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>