<div class="modal fade" id="addpmModal" tabindex="-1" aria-labelledby="addpmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="mod-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="addpmModalLabel">Payment Method</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="payment" id="payment-box">
                       <?php include 'loaddefaultlink.php';?>
      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary modal-btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark modal-btn" id="proceedButton">Next</button>
                </div>
            </div>
        </div>
    </div>