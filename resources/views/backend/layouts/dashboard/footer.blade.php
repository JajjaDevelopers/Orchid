 <div class="az-footer ht-40 text-danger">
     <div class="container-fluid pd-t-0-f ht-100p">
         <span>&copy;<span id="current-year"></span> Petra Reformed Baptist Church (PRBC)</span>
         {{-- <span>Designed by: K Felix</span> --}}
     </div><!-- container -->
 </div><!-- az-footer -->
 <script>
    const date = new Date();
    const year = date.getFullYear()
    document.getElementById("current-year").textContent = year;
 </script>
