/**
 * COLLECTION - UI Rendering & Logic
 */

import projectData from './collection.data.js';

class CollectionUI {
    constructor() {
        this.container = document.getElementById('stack-target') || document.querySelector('.collection-grid');
        this.projects = projectData;
        this.init();
    }

    init() {
        if (!this.container) return;
        this.render();
        this.bindEvents();
    }

    async checkImage(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = () => resolve(true);
            img.onerror = () => resolve(false);
            img.src = url;
        });
    }

    async getValidCover(candidates) {
        for (const url of candidates) {
            if (url.startsWith('https://') || url.startsWith('http://')) return url;
            // For local files, we'd ideally check existence via fetch or relative path
            // In this environment, we'll assume the first candidate that loads
            const exists = await this.checkImage(url);
            if (exists) return url;
        }
        return 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop'; // Default Fallback
    }

    async render() {
        this.container.innerHTML = ''; // Clear previous

        for (const project of this.projects) {
            const cover = await this.getValidCover(project.coverCandidates);
            const card = this.createCard(project, cover);
            this.container.appendChild(card);
        }

        // Dispatch event for animations to re-init
        document.dispatchEvent(new CustomEvent('collection:rendered'));
    }

    createCard(data, cover) {
        const card = document.createElement('div');
        card.className = 'collection-card';
        card.setAttribute('data-id', data.id);
        card.tabIndex = 0;

        const tagsHTML = data.tags.map(tag => `<span class="c-tag">${tag}</span>`).join('');
        const internalBadge = data.isInternal ? `<span class="c-internal">Projet Interne</span>` : '';

        card.innerHTML = `
      <div class="c-card-inner">
        <div class="c-image-wrapper">
          <img src="${cover}" alt="${data.title}" class="c-cover" loading="lazy" decoding="async">
          <div class="c-grain"></div>
        </div>
        <div class="c-content">
          <div class="c-tags">${tagsHTML}</div>
          <h3 class="c-title">${data.title}</h3>
          <p class="c-impact">${data.impact}</p>
          <div class="c-footer">
             <a href="${data.href}" class="c-link">${data.isInternal ? 'Détails' : 'Voir le site'} <i class="fas fa-arrow-right"></i></a>
             ${internalBadge}
          </div>
        </div>
        <div class="c-indicator">Open View</div>
      </div>
    `;

        return card;
    }

    bindEvents() {
        // Par parcourir trigger
        const trigger = document.querySelector('.collection-trigger');
        if (trigger) {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                document.dispatchEvent(new CustomEvent('collection:explore'));
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.Collection = new CollectionUI();
});
