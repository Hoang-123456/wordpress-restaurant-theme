/**
 * Restaurant Theme – menu
 * Loads menu.json, renders cards, and filters client-side.
 * No framework, no external dependencies.
 */
(function () {
  'use strict';

  var root = document.getElementById('menu-app');
  if (!root) return;

  var dataUrl = root.getAttribute('data-src');
  var state = { data: null, category: 'all', query: '', vegOnly: false };

  // References to the static shell elements from the pattern
  var els = {
    filters: root.querySelector('.menu-filters'),
    search:  root.querySelector('.menu-search-input'),
    veg:     root.querySelector('.menu-veg-toggle'),
    list:    root.querySelector('.menu-list'),
    status:  root.querySelector('.menu-status'),
    note:    root.querySelector('.menu-note')
  };

  function esc(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  function load() {
    fetch(dataUrl)
      .then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function (json) {
        state.data = json;
        buildFilters();
        if (els.note && json.note) els.note.textContent = json.note;
        render();
      })
      .catch(function () {
        els.list.innerHTML =
          '<p class="menu-error">Die Speisekarte konnte nicht geladen werden. ' +
          'Bitte laden Sie die Seite neu oder rufen Sie uns an.</p>';
      });
  }

  function buildFilters() {
    var cats = state.data.categories;
    var buttons = [makeFilterBtn('all', 'Alles', true)];
    cats.forEach(function (c) {
      buttons.push(makeFilterBtn(c.id, c.name, false));
    });
    els.filters.innerHTML = buttons.join('');

    els.filters.addEventListener('click', function (e) {
      var btn = e.target.closest('button[data-cat]');
      if (!btn) return;
      state.category = btn.getAttribute('data-cat');
      els.filters.querySelectorAll('button').forEach(function (b) {
        var active = b === btn;
        b.classList.toggle('is-active', active);
        b.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      render();
    });
  }

  function makeFilterBtn(id, label, active) {
    return (
      '<button type="button" class="menu-filter' + (active ? ' is-active' : '') +
      '" data-cat="' + esc(id) + '" aria-pressed="' + (active ? 'true' : 'false') +
      '">' + esc(label) + '</button>'
    );
  }

  function matches(item) {
    if (state.vegOnly && item.tags.indexOf('vegetarian') === -1 && item.tags.indexOf('vegan') === -1) {
      return false;
    }
    if (state.query) {
      var hay = (item.name + ' ' + (item.desc || '')).toLowerCase();
      if (hay.indexOf(state.query) === -1) return false;
    }
    return true;
  }

  function render() {
    var cur = state.currency = state.data.currency || '€';
    var tagLabels = state.data.tags || {};
    var cats = state.data.categories.filter(function (c) {
      return state.category === 'all' || c.id === state.category;
    });

    var html = '';
    var total = 0;

    cats.forEach(function (cat) {
      var items = cat.items.filter(matches);
      if (!items.length) return;
      total += items.length;

      html += '<section class="menu-group" aria-labelledby="cat-' + esc(cat.id) + '">';
      html += '<h3 id="cat-' + esc(cat.id) + '" class="menu-group-title">' + esc(cat.name) + '</h3>';
      html += '<ul class="menu-items">';

      items.forEach(function (item) {
        var tags = (item.tags || []).map(function (t) {
          return '<span class="menu-tag menu-tag--' + esc(t) + '">' + esc(tagLabels[t] || t) + '</span>';
        }).join('');

        html += '<li class="menu-item">' +
          '<div class="menu-item-head">' +
            '<h4 class="menu-item-name">' + esc(item.name) + '</h4>' +
            '<span class="menu-item-dots" aria-hidden="true"></span>' +
            '<span class="menu-item-price">' + esc(cur) + ' ' + esc(item.price) + '</span>' +
          '</div>' +
          (item.desc ? '<p class="menu-item-desc">' + esc(item.desc) + '</p>' : '') +
          (tags ? '<div class="menu-item-tags">' + tags + '</div>' : '') +
        '</li>';
      });

      html += '</ul></section>';
    });

    if (!total) {
      html = '<p class="menu-empty">Keine Gerichte gefunden. Passen Sie Ihre Suche oder Filter an.</p>';
    }

    els.list.innerHTML = html;
    els.status.textContent = total === 1
      ? '1 Gericht angezeigt'
      : total + ' Gerichte angezeigt';
  }

  // Search (debounced) + vegetarian toggle
  var debounce;
  els.search.addEventListener('input', function () {
    clearTimeout(debounce);
    debounce = setTimeout(function () {
      state.query = els.search.value.trim().toLowerCase();
      render();
    }, 180);
  });

  els.veg.addEventListener('change', function () {
    state.vegOnly = els.veg.checked;
    render();
  });

  load();
})();
