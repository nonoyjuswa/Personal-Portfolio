<?php
$pageTitle = "Joshua Tamayo - Portfolio";
require "php/settings.php";
$contactRows = contact_rows(get_settings());
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
          <h2 class="contact__headline" id="contact-title"><em>Let's create</em> something extraordinary.</h2>
          <a href="#contact-form" class="hero__pill">Let's work together <span aria-hidden="true">&rarr;</span></a>
        </div>

        <div class="contact__art" aria-hidden="true">
          <div class="contact__arch">
            <img src="images/contact-arch.png" alt="" onerror="this.remove()">
          </div>
          <svg class="contact__art-spark" viewBox="0 0 40 40"><path d="M20 2 L23 17 L38 20 L23 23 L20 38 L17 23 L2 20 L17 17 Z"/></svg>
        </div>

        <ul class="contact__info">
          <?php foreach ($contactRows as $r): if ($r["value"] === "") continue; ?>
            <li class="contact__info-item">
              <span class="contact__icon"><svg viewBox="0 0 24 24" aria-hidden="true"><?= $r["icon"] ?></svg></span>
              <div class="contact__info-text">
                <span class="contact__info-head">
                  <span class="contact__info-label"><?= e($r["label"]) ?></span>
                  <?php if ($r["copy"]): ?>
                    <button type="button" class="contact__copy" data-copy="<?= e($r["value"]) ?>">Copy</button>
                  <?php endif; ?>
                </span>
                <?php if ($r["href"] !== ""): ?>
                  <a class="contact__info-value" href="<?= e($r["href"]) ?>"<?= $r["external"] ? ' target="_blank" rel="noopener"' : "" ?>><?= e($r["value"]) ?></a>
                <?php else: ?>
                  <span class="contact__info-value"><?= e($r["value"]) ?></span>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="contact__brand">
          <span class="contact__monogram">JT</span>
          <p class="contact__tagline">Designing digital experiences that leave a lasting impact.</p>
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