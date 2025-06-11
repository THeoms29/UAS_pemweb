document.addEventListener('DOMContentLoaded', function() {
 
    const galleryItems = document.querySelectorAll('.gallery-item');
    const searchInput = document.querySelector('.search-input');
    
    if (searchInput) {
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        galleryItems.forEach(item => {
          const caption = item.querySelector('.caption').textContent.toLowerCase();
          if (caption.includes(searchTerm)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    }
    
    galleryItems.forEach(item => {
      item.addEventListener('click', function() {
        const imgSrc = this.querySelector('.gallery-img').src;
        window.open(imgSrc, '_blank');
      });
    });
  });