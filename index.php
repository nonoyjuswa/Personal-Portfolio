<?php
$pageTitle = "Joshua Tamayo - Portfolio";
include "partials/head.php";
?>
  <?php include "partials/navbar.php"; ?>
  <div class="hero-shell">  
    <section class="hero" id="hero">
      <div class="hero__content">
        <p class="hero__eyebrow">JOB TITLE &amp; WHAT YOU DO <span class="hero__eyebrow-line"></span></p>
        <h1 class="hero__title">
          <span class="hero__line">Build
            <svg class="hero__spark" viewBox="0 0 40 40" aria-hidden="true"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
          </span>
          <span class="hero__line"><em>with</em> Intent</span>
        </h1>
        <p class="hero__sub">I'm Joshua Tamayo. I build digital experiences that are functional, thoughtful, and made with the user in mind.</p>
        <div class="hero__actions">
          <a href="#projects" class="hero__pill">View My Work <span aria-hidden="true">&rarr;</span></a>
          <a href="php/download-cv.php" class="hero__link">Download CV <span aria-hidden="true">&darr;</span></a>
        </div>
      </div>

      <div class="hero__art">
        <div class="hero__arch-outline"></div>
        <div class="hero__arch"><img src="images/dsad.png" alt="Joshua Tamayo"></div>
        <svg class="hero__art-spark" viewBox="0 0 40 40" aria-hidden="true"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
        <div class="hero__badge">
          <svg viewBox="0 0 120 120" class="hero__badge-ring" aria-hidden="true">
            <defs><path id="badgeCircle" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0"/></defs>
            <text><textPath href="#badgeCircle">USER-CENTERED &#8226; IMPACT-DRIVEN &#8226;</textPath></text>
          </svg>
          <span class="hero__badge-mark">JT</span>
        </div>
      </div>
    </section>
  </div>

  <main>

    <section class="section info-strip" aria-label="At a glance">
      <div class="info-strip__inner">
        <div class="info-strip__item">
          <span class="info-strip__label">Based in</span>
          <p class="info-strip__value">Iloilo City, Philippines</p>
        </div>

        <div class="info-strip__item">
          <span class="info-strip__label">Available for</span>
          <p class="info-strip__value">Internships &amp; Freelance</p>
        </div>

        <div class="info-strip__item info-strip__item--sign">
          <span class="info-strip__signature">Joshua Tamayo</span>
          <svg class="info-strip__spark" viewBox="0 0 40 40" aria-hidden="true"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
        </div>

        <div class="info-strip__item">
          <p class="info-strip__tagline">Turning ideas<br>into meaningful<br>digital experiences.</p>
        </div>
      </div>
    </section>

    <section class="section section--dark featured-work" id="projects" aria-labelledby="featured-work-title">
      <div class="featured-work__head">
        <h2 class="featured-work__title" id="featured-work-title">
          <svg class="featured-work__spark" viewBox="0 0 40 40" aria-hidden="true"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
          Featured Work
        </h2>
        <a href="#" class="featured-work__all">View all projects</a>
      </div>
      <div class="featured-work__grid" id="project-grid">
        <noscript>Enable JavaScript to see projects.</noscript>
      </div>
    </section>

    <section class="section section--dark what-i-do" id="skills" aria-labelledby="what-i-do-title">
      <div class="what-i-do__layout">
        <div class="what-i-do__intro">
          <h2 class="what-i-do__title" id="what-i-do-title">What I Do</h2>
          <span class="what-i-do__rule"></span>
        </div>
        <div class="what-i-do__grid" id="service-grid"></div>
      </div>
    </section>

    <section class="section section--dark case-studies" id="case-studies" aria-labelledby="case-studies-title">
      <div class="case-studies__head">
        <h2 class="case-studies__title" id="case-studies-title">
          <svg class="case-studies__spark" viewBox="0 0 40 40" aria-hidden="true"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
          Case Studies
        </h2>
        <a href="#projects" class="case-studies__all">See all case studies <span class="arrow-btn" aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="case-studies__grid" id="case-study-grid"></div>
    </section>

    <section class="section" id="about">

        <!-- decorative wireframe globe (top right) -->
        <svg class="ab-globe" viewBox="0 0 200 200" aria-hidden="true">
            <circle cx="100" cy="100" r="90"/>
            <ellipse cx="100" cy="100" rx="90" ry="34"/>
            <ellipse cx="100" cy="100" rx="90" ry="62"/>
            <ellipse cx="100" cy="100" rx="34" ry="90"/>
            <ellipse cx="100" cy="100" rx="62" ry="90"/>
            <path d="M100 10v180M10 100h180"/>
        </svg>

        <div class="ab-layout">

            <!-- LEFT: About me -->
            <div class="ab-col ab-col-about">
                <h2 class="ab-label">About Me</h2>

                <div class="ab-about-row">
                    <div class="ab-portrait">
                        <img src="images/dsad.png" alt="Joshua Tamayo">
                    </div>

                    <div class="ab-text">
                        <p>I'm a Computer Science student with a growing interest in product management, software development, and building useful solutions to real-world problems.</p>
                        <p>I enjoy turning ideas into structured plans and finding better ways to solve problems&mdash;not just technically, but from the user's perspective.</p>

                        <ul class="ab-traits">
                            <li>Curious &amp; always learning</li>
                            <li>Problem solver</li>
                            <li>Product-minded</li>
                            <li>Collaborative leader</li>
                            <li>Driven by continuous improvement</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Tools + quote -->
            <div class="ab-col ab-col-tools">
                <h2 class="ab-label">Tools I Use</h2>

                <ul class="ab-tools">
                    <li><span class="ab-tile">VS</span><span class="ab-tool-name">VS Code</span></li>
                    <li><span class="ab-tile">Gh</span><span class="ab-tool-name">GitHub</span></li>
                    <li><span class="ab-tile">Py</span><span class="ab-tool-name">Python</span></li>
                    <li><span class="ab-tile">JS</span><span class="ab-tool-name">JavaScript</span></li>
                    <li><span class="ab-tile">Fg</span><span class="ab-tool-name">Figma</span></li>
                </ul>

                <!-- Swap this for a real testimonial or a personal quote -->
                <blockquote class="ab-quote">
                    <span class="ab-quote-mark" aria-hidden="true">&ldquo;</span>
                    <p>Joshua turns ideas into clear plans and follows through. He always thinks about the user first.</p>
                    <cite>&mdash; Teammate Feedback</cite>
                </blockquote>
            </div>

        </div>
    </section>

    <section class="section section--dark contact" id="contact" aria-labelledby="contact-title">
      <div class="contact__panel">
        <div class="contact__col">
          <h2 class="contact__title" id="contact-title">Let's Collaborate</h2>
          <p class="contact__intro">Have a project in mind or just want to say hi? I'd love to hear from you.</p>
          <ul class="contact__info">
            <li class="contact__info-item">
              <span class="contact__icon"><svg viewBox="0 0 24 24"><path d="M3 5h18v14H3z"/><path d="M3 6l9 7 9-7"/></svg></span>
              <!-- TODO: replace with your real email -->
              you@example.com
            </li>
            <li class="contact__info-item">
              <span class="contact__icon"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.4 2.1L8.1 9.7a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.7.6a2 2 0 0 1 1.9 2.2z"/></svg></span>
              <!-- TODO: replace with your real phone number -->
              +63 000 000 0000
            </li>
            <li class="contact__info-item">
              <span class="contact__icon"><svg viewBox="0 0 24 24"><path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
              Iloilo City, Philippines
            </li>
            <li class="contact__info-item">
              <span class="contact__icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a13 13 0 0 1 0 18 13 13 0 0 1 0-18z"/></svg></span>
              github.com/nonoyjuswa
            </li>
          </ul>
        </div>

        <div class="contact__col">
          <h2 class="contact__title">Scan to Connect</h2>
          <div class="contact__qr-row">
            <div class="contact__qr-item">
              <div class="contact__qr-frame">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&amp;bgcolor=f3e9e2&amp;color=1c0d10&amp;data=https://www.linkedin.com/in/joshua-tamayo-iloilo/" alt="LinkedIn QR code">
                <div class="contact__qr-badge">in</div>
              </div>
              <div class="contact__qr-label">LinkedIn</div>
            </div>
            <div class="contact__qr-item">
              <div class="contact__qr-frame">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&amp;bgcolor=f3e9e2&amp;color=1c0d10&amp;data=https://github.com/nonoyjuswa" alt="GitHub QR code">
                <div class="contact__qr-badge">Gh</div>
              </div>
              <div class="contact__qr-label">GitHub</div>
            </div>
          </div>
        </div>

        <div class="contact__col contact__col--tagline">
          <svg class="contact__spark" viewBox="0 0 40 40" fill="none" aria-hidden="true">
            <path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z" fill="var(--coral)" opacity="0.9"/>
          </svg>
          <p class="contact__tagline">Designing<br>experiences.<br>Building<br>connections.</p>
          <svg class="contact__signature" viewBox="0 0 140 50" fill="none" aria-hidden="true">
            <path d="M5 35 Q15 10 25 30 T45 20 Q55 8 60 30 T85 15 Q95 5 100 28 T130 18" stroke="var(--light-muted)" stroke-width="1.6" fill="none" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
    </section>

    <section class="section section--dark contact contact--form" id="contact-form" aria-labelledby="contact-form-title">
      <h2 class="contact__title" id="contact-form-title">Send a Message</h2>

      <?php $status = $_GET["status"] ?? ""; ?>
      <?php if ($status === "sent"): ?>
        <p class="form-alert form-alert--ok" role="status">Thanks! Your message was sent.</p>
      <?php elseif ($status === "invalid"): ?>
        <p class="form-alert form-alert--error" role="alert">Please fill in every field with a valid email address.</p>
      <?php elseif ($status === "error"): ?>
        <p class="form-alert form-alert--error" role="alert">Something went wrong on our side. Please try again later.</p>
      <?php endif; ?>

      <form class="contact__form" action="php/send-message.php" method="POST">
        <div class="contact__form-row">
          <input class="contact__field" type="text" name="name" placeholder="Your name" maxlength="100" required>
          <input class="contact__field" type="email" name="email" placeholder="Your email" maxlength="150" required>
        </div>
        <textarea class="contact__field" name="message" placeholder="Your message" maxlength="2000" required></textarea>

        <input class="contact__hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">

        <button class="contact__submit" type="submit">Send Message <span aria-hidden="true">&rarr;</span></button>
      </form>
    </section>

  </main>

  <?php include "partials/footer.php"; ?>