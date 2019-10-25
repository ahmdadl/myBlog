import Vue, { VNode } from "vue";
import Component from "vue-class-component";
import * as Compo from "./components/index";
import BootstrapVue from "bootstrap-vue";
import Axios from "axios";

Vue.config.productionTip = false;
Vue.use(BootstrapVue);

Vue.filter("json", x => {
    return x * 13;
});

Vue.filter("capt", (str: string) => {
    if (!str) return "";
    let output: Array<string> = [];
    str.split(" ").forEach(word => {
        output.push(word[0].toUpperCase() + word.slice(1));
    });

    return output.join(" ");
});

Vue.filter("uppercase", (str: string) => {
    return str.toUpperCase();
});

/**
 * Register components
 */
Vue.component("stable", Compo.Table);
Vue.component("anime", Compo.Anime);
Vue.component("post-modal", Compo.PostModal);

const Data = {
    title: "shopping list in here",
    items: ["asd", "eerd", "trtr"],
    limit: 10,
    memeText: "",
    showSolution: "",
    someOf: false,
    printer: [],
    gender: [],
    dialog: [
        "Hi",
        "Some time Please",
        "We are finishing stuff",
        "for you",
        "please...",
        "be patient",
        "will be over soon"
    ],
    fruite: [
        "They call me fruit.",
        "They call me fish.",
        "They call me insect.",
        "But actually I'm not one of those",
        "I`m a Dragon",
        "Fire Breather"
    ],
    refre: "some",
    imageSrc: false,
    imgs: [1, 2, 3, 4, 5],
    posts: null,
    post: null,
    tasks: [],
    updatingTask: false
};

const Comput = {
    isNighty: () => {
        return new Date().getHours() < 21;
    },
    longText: function() {
        return this.memeText.length >= 3;
    }
};

const Funct = {
    superMe() {
        console.log(this.$el, this.$refs);
        console.log(this.$refs.anm.classList);
        this.$refs.anm.classList.add("btn-danger");
    },
    checkTask(postSlug: string, taskId: number, taskIndex: number): void {
        let loader = this.$refs['spinner' + taskId][0]
        const TaskDone = !this.$refs[taskId][0].checked

        // remove d-none from loader classes
        loader.classList = []

        Axios.put('/api/posts/' + postSlug + '/tasks/' + taskId, {
            done: TaskDone
        })
            .then(res => {
                console.log(res)
                if (res.data.done === TaskDone && res.status === 200) {
                    this.post.tasks[taskIndex].done = TaskDone
                }
            })
            .catch(err => console.log(err))
            .finally(() => {
                // hide loader
                loader.classList.add('d-none')
            })
    }
};

const App = new Vue({
    el: "#app",
    data: Data,
    computed: Comput,
    methods: Funct,
    mounted() {
        const Path = document.location.pathname;
        if (Path === "/api/posts") {
            Axios.get("/json/posts")
                .then(res => {
                    this.posts = res.data.data;
                    console.log(res.data.data);
                })
                .catch(err => console.error(err));
        } else {
            const PostSlug = Path.replace("/api/posts/", "");
            document.title = PostSlug;
            Axios.get("/json/posts/" + PostSlug)
                .then(res => {
                    this.post = res.data.data;
                    console.log(res.data.data);
                })
                .catch(err => console.error(err));
        }
    }
});
