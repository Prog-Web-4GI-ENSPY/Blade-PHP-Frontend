// Accordion
  document.querySelectorAll('.accordion-header').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.parentElement;
      const wasOpen = item.getAttribute('aria-expanded') === 'true';
      document.querySelectorAll('.accordion-item[aria-expanded="true"]')
        .forEach(open => { if (open !== item) open.setAttribute('aria-expanded', 'false'); });
      item.setAttribute('aria-expanded', !wasOpen);
    });
  });

  // Support Form
  const form = document.getElementById('supportForm');
  const successMsg = document.getElementById('formSuccess');

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    let valid = true;

    // Reset errors
    document.querySelectorAll('.error-msg').forEach(el => el.textContent = '');

    const email = form.email.value.trim();
    const message = form.message.value.trim();

    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
      form.email.nextElementSibling.textContent = 'Please enter a valid email.';
      valid = false;
    }
    if (!message) {
      form.message.nextElementSibling.textContent = 'Please describe your issue.';
      valid = false;
    }

    if (valid) {
      form.style.display = 'none';
      successMsg.style.display = 'flex';
      // In real app: send to backend
      console.log('Support request:', { email, message });
    }
  });

  // Copy email
  document.querySelectorAll('.email-link').forEach(link => {
    link.addEventListener('click', async e => {
      e.preventDefault();
      const text = link.dataset.copy;
      try {
        await navigator.clipboard.writeText(text);
        const fb = link.nextElementSibling;
        fb.classList.add('show');
        setTimeout(() => fb.classList.remove('show'), 1500);
      } catch { alert('Copy failed'); }
    });
  });

  // Dark mode
  const darkSwitch = document.getElementById('darkSwitch');
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
    darkSwitch.checked = true;
  }
  darkSwitch.addEventListener('change', () => {
    if (darkSwitch.checked) {
      document.body.classList.add('dark-mode');
      localStorage.setItem('darkMode', 'enabled');
    } else {
      document.body.classList.remove('dark-mode');
      localStorage.setItem('darkMode', 'disabled');
    }
  });