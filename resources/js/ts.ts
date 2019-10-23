import Vue, { VNode } from "vue";
import Component from "vue-class-component"
import * as Compo from './components/index'
import BootstrapVue from 'bootstrap-vue'

Vue.config.productionTip = false
Vue.use(BootstrapVue)

Vue.filter('json', (x) => {
    return x*13;
})

Vue.filter('capt', (str: string) => {
    if(!str) return ''
    let output: Array<string> = []
    str.split(' ').forEach(word => {
        output.push(word[0].toUpperCase() + word.slice(1))
    })

    return output.join(' ')
})

Vue.filter('uppercase', (str: string) => {
    return str.toUpperCase();
})

/**
 * Register components
 */
Vue.component('stable', Compo.Table)
Vue.component('anime', Compo.Anime)

const Data = {
    title: 'shopping list in here',
    items: ['asd', 'eerd', 'trtr'],
    limit: 10,
    memeText: '',
    showSolution: '',
    someOf: false,
    printer: [],
    gender: [],
    dialog: ['Hi', 'Some time Please', 'We are finishing stuff', 'for you', 'please...', 'be patient', 'will be over soon'],
    fruite:  ["They call me fruit.", "They call me fish.", "They call me insect.", "But actually I'm not one of those", "I`m a Dragon", 'Fire Breather'],
    refre: 'some'
}

const Comput = {
    isNighty: () => {
        return new Date().getHours() < 21
    },
    longText: function () {
        // console.log(this.$refs)
        return this.memeText.length >= 3
    }
}

const Funct = {
    superMe () {
        console.log(this.$el, this.$refs)
        console.log(this.$refs.anm.classList)
        this.$refs.anm.classList.add('btn-danger')
    }
}

const App = new Vue({
    el: '#app',
    data: Data,
    computed: Comput,
    methods: Funct
})