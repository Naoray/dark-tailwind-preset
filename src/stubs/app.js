require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(key.split('/').pop().split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
  
    data: {
      showDropdown: false
    },
  
    methods: {
      toggleDropdown() {
        this.showDropdown = !this.showDropdown
        this.$refs.dropdown.style.display = this.showDropdown ? 'block' : 'none'
  
        if (this.showDropdown) {
          this.$nextTick(() => {
            document.addEventListener('click', this.closeDropdownListener)
          })
        }
      },
  
      closeDropdownListener(event) {
        if (event.target.closest('.dropdown')) {
          return
        }
  
        this.toggleDropdown()
        document.removeEventListener('click', this.closeDropdownListener)
      }
    }
  });
