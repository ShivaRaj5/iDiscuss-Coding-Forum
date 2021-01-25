<!--Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up To Create An Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/partials/_handleSignup.php" method="post">
                    <div class="form-group">
                        <label for="signupEmail">Username</label>
                        <input type="text" class="form-control" name="signupEmail" id="signupEmail" aria-describedby="emailHelp">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" class="form-control" name="signupPassword" id="password">
                    </div>
                    <div class="form-group">
                        <label for="csignupPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="csignupPassword" id="csignupPassword">
                        <small id="emailHelp" class="form-text text-muted">Make Sure To Enter The Same Password.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>