/**
 * Thiennguyen User Profile JavaScript
 * Handles tabs and interactions for the user profile page
 */

// DOM selectors
const tabElements = document.querySelectorAll('.MuiTab-root');
const followButton = document.querySelector('.MuiButton-containedPrimary');
const switchElements = document.querySelectorAll('.switch');
const viewAllButton = document.querySelector('.btnViewAll');

// Tab functionality
function initTabs() {
  if (tabElements.length > 0) {
    tabElements.forEach((tab) => {
      tab.addEventListener('click', () => {
        // Remove selected state from all tabs
        tabElements.forEach((t) => {
          t.classList.remove('Mui-selected');
        });

        // Add selected state to clicked tab
        tab.classList.add('Mui-selected');

        // Update indicator position
        const indicator = document.querySelector('.MuiTabs-indicator');
        if (indicator) {
          indicator.style.left = `${tab.offsetLeft}px`;
          indicator.style.width = `${tab.offsetWidth}px`;
        }
      });
    });
  }
}

// Follow button functionality
function initFollowButton() {
  if (followButton) {
    followButton.addEventListener('click', () => {
      const isFollowing = followButton.textContent.trim() === 'Đang theo dõi';

      if (isFollowing) {
        followButton.textContent = 'Theo dõi';
        const imgElement = followButton.querySelector('img');
        if (imgElement) {
          imgElement.setAttribute('src', '/images/icon-follow.svg');
        }
      } else {
        followButton.textContent = 'Đang theo dõi';
        const imgElement = followButton.querySelector('img');
        if (imgElement) {
          imgElement.setAttribute('src', '/images/icon-following.svg');
        }
      }
    });
  }
}

// Switch functionality in following section
function initSwitches() {
  if (switchElements.length > 0) {
    switchElements.forEach((switchEl) => {
      switchEl.addEventListener('click', () => {
        // Toggle active state
        switchElements.forEach((s) => {
          s.classList.remove('switchActive');
        });
        switchEl.classList.add('switchActive');
      });
    });
  }
}

// Mobile menu toggle
function initMobileMenu() {
  const mobileMenuToggle = document.querySelector('.header-mobile-left');
  const mobileMenu = document.querySelector('.header-mobile-menu');

  if (mobileMenuToggle && mobileMenu) {
    mobileMenuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });
  }
}

// Initialize all functionality
function init() {
  initTabs();
  initFollowButton();
  initSwitches();
  initMobileMenu();
}

// Run initialization when DOM is loaded
document.addEventListener('DOMContentLoaded', init);
