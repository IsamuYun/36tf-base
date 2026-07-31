document.querySelectorAll('.tf-carousel').forEach((root) => {
  const track  = root.querySelector('.tf-carousel__track');
  const slides = [...track.children];
  if (slides.length < 2) return;

  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  let index = 0, timer = null;

  const dots = document.createElement('div');
  dots.className = 'tf-carousel__dots';
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.className = 'tf-carousel__dot';
    b.setAttribute('aria-label', `第 ${i + 1} 张`);
    b.addEventListener('click', () => go(i, true));
    dots.appendChild(b);
  });
  root.appendChild(dots);

  function paint() {
    dots.querySelectorAll('button').forEach((b, i) =>
      b.setAttribute('aria-current', i === index ? 'true' : 'false'));
  }
  function go(i, manual) {
    index = (i + slides.length) % slides.length;
    track.scrollTo({ left: track.clientWidth * index, behavior: reduce ? 'auto' : 'smooth' });
    paint();
    if (manual) restart();
  }
  function restart() {
    clearInterval(timer);
    if (!reduce) timer = setInterval(() => go(index + 1), 5000);
  }

  track.addEventListener('scroll', () => {
    const i = Math.round(track.scrollLeft / track.clientWidth);
    if (i !== index) { index = i; paint(); }
  }, { passive: true });

  root.addEventListener('mouseenter', () => clearInterval(timer));
  root.addEventListener('mouseleave', restart);
  document.addEventListener('visibilitychange', () =>
    document.hidden ? clearInterval(timer) : restart());

  paint();
  restart();
});