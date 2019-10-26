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
    updatingTask: false,
    newTask: "",
    taskBodyError: null,
    newTaskError: false,
    taskSaving: null,
    newComment: "",
    comErr: null,
    commentSaving: null
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
        let loader = this.$refs["spinner" + taskId][0];
        const TaskDone = !this.$refs[taskId][0].checked;

        // remove d-none from loader classes
        loader.classList = [];

        Axios.put("/api/posts/" + postSlug + "/tasks/" + taskId, {
            done: TaskDone
        })
            .then(res => {
                console.log(res);
                if (res.data.done === TaskDone && res.status === 200) {
                    this.post.tasks[taskIndex].done = TaskDone;
                }
            })
            .catch(err => console.log(err))
            .finally(() => {
                // hide loader
                loader.classList.add("d-none");
            });
    },
    saveTask(postSlug: string): void {
        this.taskBodyError = this.newTaskError = null;
        this.taskSaving = true;

        if (this.newTask.length < 5 || this.newTask.length > 70) {
            this.newTaskError = true;
            return;
        }

        Axios.post("/posts/" + postSlug + "/tasks", {
            body: this.newTask
        })
            .then(res => {
                console.log(res);

                if (res.status === 201) {
                    this.post.tasks.push(res.data);
                }
            })
            .catch(err => {
                console.log(err);
                if (err.response) {
                    this.taskBodyError =
                        err.response.data.errors.body[0] ||
                        err.response.data.message;
                }
            })
            .finally(() => (this.taskSaving = null));
    },
    addComment(postSlug: string): void {
        this.commErr = null;
        this.commentSaving = true;

        if (this.newComment.length < 25 || this.newComment.length > 350) {
            this.comErr = "";
            this.commentSaving = false;
            return;
        }

        Axios.post("/posts/" + postSlug + "/comments", {
            body: this.newComment
        })
            .then(res => {
                console.log(res);
                if (res.status === 201) {
                    this.newComment = "";
                    this.post.comments.unshift(res.data);
                    setTimeout(() => {
                        this.$refs["com" + res.data.id][0].classList.value += ' buffer'
                    }, 100);
                }
            })
            .catch(err => {
                console.log(err.response || err);

                if (err.response) {
                    this.comErr =
                        err.response.data.errors.body[0] ||
                        err.response.data.message;
                }
            })
            .finally(() => {
                this.commentSaving = false;
            });
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
