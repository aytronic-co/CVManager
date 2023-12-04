import { defineStore } from 'pinia'

export const useAppDataStore = defineStore('AppData', {
  state: () => ({
    counter: 0 ,
    mobile: null
  }),

  getters: {
    doubleCount (state) {
      return state.counter * 2
    }
  },

  actions: {
    increment () {
      this.counter++
    }
  }
})
