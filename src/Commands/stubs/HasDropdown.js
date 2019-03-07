export default {
  data() {
    return {
      showDropdown: false
    }
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
}