document.addEventListener('DOMContentLoaded', function() {
    // Create modal elements dynamically
    const modal = document.createElement('div');
    modal.id = 'imageModal';
    
    const modalContent = document.createElement('div');
    modalContent.id = 'modalContent'
    
    const modalImg = document.createElement('img');
    modalImg.id = 'modalImage';
   
    
    const closeBtn = document.createElement('span');
    closeBtn.id = 'closeModal';
    closeBtn.innerHTML = '&times;';
    
    
    document.body.appendChild(modal);
    modal.appendChild(closeBtn);
    modal.appendChild(modalContent);
    modalContent.appendChild(modalImg);

    // Event listeners for modal
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Gallery functionality
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
            modalImg.src = imgSrc;
            modal.style.display = 'block';
        });
    });
});

  // JSgallery.js
document.addEventListener('DOMContentLoaded', () => {
  const container     = document.querySelector('.gallery-container');
  const items         = Array.from(container.querySelectorAll('.gallery-item'));
  const paginationUL  = document.querySelector('.pagination');
  let pages           = [];
  let currentPage     = 1;

  // 1) Compute how many rows each item spans
  function applyGridSpans() {
    const styles = getComputedStyle(container);
    const rowH   = parseInt(styles.getPropertyValue('grid-auto-rows'), 10);
    const rowGap = parseInt(styles.getPropertyValue('grid-gap'), 10);

    items.forEach(item => {
      const img     = item.querySelector('img');
      const width   = item.clientWidth;
      // maintain aspect ratio to get rendered height
      const height  = img.naturalHeight / img.naturalWidth * width;
      const span    = Math.ceil((height + rowGap) / (rowH + rowGap));
      item.style.gridRowEnd = `span ${span}`;
    });
  }

  // 2) Group items into pages by container height
  function computePages() {
    pages = [];
    const pageHeight = (2000 * 2);
    let batch = [];
    let accH  = 0;

    items.forEach(item => {
      const itemH = item.getBoundingClientRect().height;
      // if adding would overflow, start a new page (unless batch is empty)
      if (batch.length && accH + itemH > pageHeight) {
        pages.push(batch);
        batch = [];
        accH = 0;
      }
      batch.push(item);
      accH += itemH;
    });
    if (batch.length) pages.push(batch);
  }

  // 3) Build the Prev / page # / Next controls
  function buildPagination() {
    const total = pages.length;
    paginationUL.innerHTML = '';

    // Prev
    paginationUL.innerHTML += `
      <li>
        <a href="#" class="prev${currentPage === 1 ? ' disabled' : ''}">«</a>
      </li>`;

    // Page numbers
    for (let i = 1; i <= total; i++) {
      paginationUL.innerHTML += `
        <li>
          <a href="#" data-page="${i}" class="${i === currentPage ? 'active' : ''}">${i}</a>
        </li>`;
    }

    // Next
    paginationUL.innerHTML += `
      <li>
        <a href="#" class="next${currentPage === total ? ' disabled' : ''}">»</a>
      </li>`;
  }

  // 4) Show only the items for `page`
  function showPage(page) {
    items.forEach(item => item.style.display = 'none');
    pages[page - 1].forEach(item => item.style.display = 'block');
  }

  // 5) Wire up Prev/Next/Page clicks
  paginationUL.addEventListener('click', e => {
    e.preventDefault();
    const a = e.target.closest('a');
    if (!a || a.classList.contains('disabled')) return;

    if (a.classList.contains('prev') && currentPage > 1) {
      currentPage--;
    } else if (a.classList.contains('next') && currentPage < pages.length) {
      currentPage++;
    } else if (a.dataset.page) {
      currentPage = Number(a.dataset.page);
    } else {
      return;
    }

    buildPagination();
    showPage(currentPage);
  });

  // 6) Initialize once images & CSS are fully loaded
  window.addEventListener('load', () => {
    applyGridSpans();
    computePages();
    buildPagination();
    showPage(currentPage);
  });

  // 7) Recalculate on resize (responsive)
  window.addEventListener('resize', () => {
    applyGridSpans();
    computePages();
    currentPage = Math.min(currentPage, pages.length);
    buildPagination();
    showPage(currentPage);
  });
});