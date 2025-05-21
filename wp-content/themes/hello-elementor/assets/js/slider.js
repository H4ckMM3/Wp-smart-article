document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.products-carousel');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const productCards = document.querySelectorAll('.product-card');

    if (productCards.length > 0) {
      const cardStyle = window.getComputedStyle(productCards[0]);
      const cardWidth = productCards[0].offsetWidth +
                       parseInt(cardStyle.marginLeft) +
                       parseInt(cardStyle.marginRight);

      nextBtn.addEventListener('click', () => {
        carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
      });

      prevBtn.addEventListener('click', () => {
        carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
      });
    }
  });

document.addEventListener("DOMContentLoaded", function () {
  const content = document.querySelector('.page-content') || document.querySelector('.entry-content');
  const tocList = document.querySelector('#dynamic-toc ul');
  if (!content || !tocList) return;

  const headings = content.querySelectorAll('h2, h3');
  headings.forEach((heading, index) => {
    const id = 'section-' + index;
    heading.setAttribute('id', id);

    const li = document.createElement('li');
    li.style.marginLeft = heading.tagName === 'H3' ? '20px' : '0';

    const a = document.createElement('a');
    a.href = '#' + id;
    a.textContent = heading.textContent;
    a.style.color = '#2A7D69';
    a.style.fontWeight = heading.tagName === 'H2' ? 'bold' : 'normal';

    li.appendChild(a);
    tocList.appendChild(li);
  });
});
