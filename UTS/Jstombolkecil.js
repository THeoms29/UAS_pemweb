 // Fungsi untuk tombol scroll to top
 window.onscroll = function() {scrollFunction()};
  
 function scrollFunction() {
   if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
     document.getElementById("scrollToTopBtn").style.display = "block";
   } else {
     document.getElementById("scrollToTopBtn").style.display = "none";
   }
 }
 
 document.getElementById("scrollToTopBtn").addEventListener("click", function() {
   window.scrollTo({
     top: 0,
     behavior: "smooth"
   });

   document.body.scrollTop = 0; // Untuk Safari
   document.documentElement.scrollTop = 0; // Untuk Chrome, Firefox, IE, Opera
 });