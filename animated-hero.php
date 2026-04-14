<section class="w-full">
  <div class="container mx-auto">
    <div class="flex gap-8 py-20 lg:py-40 items-center justify-center flex-col">
      <!-- Top Button -->
      <div>
        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground hover:bg-black/10 h-9 px-3 gap-4 border border-gray-200">
          Read our launch article 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </button>
      </div>

      <!-- Main Headline -->
      <div class="flex gap-4 flex-col">
        <h1 class="text-5xl md:text-7xl max-w-2xl tracking-tighter text-center font-regular">
          <span class="text-cyan-500">This is something</span>
          <!-- Animation Container -->
          <span id="hero-animated-words" class="relative flex w-full justify-center overflow-hidden text-center md:pb-4 md:pt-1 h-[1.2em]">
            <!-- Words injected via JavaScript -->
          </span>
        </h1>

        <p class="text-lg md:text-xl leading-relaxed tracking-tight text-gray-500 max-w-2xl text-center">
          Managing a small business today is already tough. Avoid further
          complications by ditching outdated, tedious trade methods. Our
          goal is to streamline SMB trade, making it easier and faster than
          ever.
        </p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-row gap-3">
        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-gray-200 bg-white hover:bg-gray-100 hover:text-gray-900 h-11 px-8 gap-4">
          Jump on a call 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        </button>
        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-gray-900 text-white hover:bg-gray-900/90 h-11 px-8 gap-4">
          Sign up here 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Inline CSS & JS for the framer-motion-like slide animation -->
<style>
  .word-slide {
    position: absolute;
    font-weight: 600;
    opacity: 0;
    transform: translateY(150px);
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.6s ease;
  }
  .word-slide.active {
    opacity: 1;
    transform: translateY(0);
  }
  .word-slide.exit {
    opacity: 0;
    transform: translateY(-150px);
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const titles = ["amazing", "new", "wonderful", "beautiful", "smart"];
    const container = document.getElementById("hero-animated-words");
    
    // Create elements for each word
    titles.forEach((title, index) => {
      const span = document.createElement("span");
      span.className = "word-slide";
      span.innerHTML = "&nbsp;" + title;
      if (index === 0) span.classList.add("active");
      container.appendChild(span);
    });

    const elements = container.querySelectorAll(".word-slide");
    let currentIndex = 0;

    // Interval to cycle through the words like the React useEffect
    setInterval(() => {
      const nextIndex = currentIndex === elements.length - 1 ? 0 : currentIndex + 1;
      
      elements[currentIndex].classList.remove("active");
      elements[currentIndex].classList.add("exit");
      
      // Reset the exit class quickly so it comes from the bottom next time
      const resetIndex = currentIndex;
      setTimeout(() => {
        elements[resetIndex].classList.remove("exit");
      }, 600); 

      elements[nextIndex].classList.add("active");
      currentIndex = nextIndex;
    }, 2000);
  });
</script>