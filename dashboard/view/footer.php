
            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; jumga.com 2021</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

            </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="../js/sydeestack.js"></script>
    <?php 
    
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        
            echo "<script src='js/$p.js'></script>";
        }
    ?>
        <!-- <div class="popup-page" id="popup-page">
           <div class="popup-content" id="popup-content">
               I AM CONTENT 
           </div>
        </div> -->
</body>

</html>