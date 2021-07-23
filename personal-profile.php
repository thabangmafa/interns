<?php 
include 'admin/connect.php';
$menu_item = "2";
$title = "Personal Profile";

 ?>
<?php require_once("admin/header.php"); ?>
        <?php require_once("menu.php"); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?php echo $title; ?></h3>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Logout</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header alert alert-primary alert-dismissible fade show">
                                    <ul>
									<li>An * at the end of a field label within a section denotes that this is a compulsory field, and the section will not be saved unless all compulsory fields have been completed.</li>
<li>Provide a brief biographical sketch (not in bullet for) giving information not already provided elsewhere in the application.</li>
<li>The introduction must be written as a narrative and could include a short overview of where , n terms of research, you have come from, in what you are interested (in very broad terms) and were you are now.</li>
<li>Mention should be made of awads and prizes, membership of editorial boards, membership of national and internation scientific committees, and other tangible recognition you have. (The latter could include citations, names o jounals for which you have been invited to act as reviewer, etc.).</li>
<li>This will enable reviewers to obtain some perspective on you and to assess your major awards and recognition. The biographical information should not exceed 5 500 characters including spaces (equivalent to one A4 page, Arial forn size 10). Note: Carriage returns are counted as two characters.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    
                                                    </div>
                                                </div>
                               
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>