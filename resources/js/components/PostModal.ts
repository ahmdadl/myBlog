import { Vue, Component } from "./vue";
import Axios from "axios";

@Component({
    props: {
        id: {
            type: String,
            required: true
        },
        allPosts: {
            required: true
        }
    },
    template: require("./post-modal.html")
})
export default class PostModal extends Vue {
    public createForm: string = "";
    private ptitle: string = "";
    private body: string = "";
    private tasks: Array<{ value: string }> = [];
    private saving = false
    /**
     * will hold all response errors
     *
     * @memberof PostModal
     */
    private errors: object = {}

    private savePost(): void {
        this.saving = true;
        this.tasks = this.tasks.filter((task, index) => {
            return !task.value ||
                task.value.length < 20 ||
                task.value.length > 255
                ? false
                : true;
        });

        this.createForm =
            this.body.length < 10 ||
            (this.ptitle.length < 10 || this.ptitle.length > 255)
                ? "was-validated"
                : "";

        if (this.createForm === "was-validated") return;

        Axios.post("/json/posts", {
            title: this.ptitle,
            body: this.body,
            tasks: JSON.stringify(this.tasks)
        })
            .then(res => {
                // console.log(res);
                if (res.status === 201) {
                    this.$bvModal.msgBoxOk("post successfully created");
                    this.$bvModal.hide("post-form");
                    this.ptitle = this.body = ""
                    this.tasks = []
                    res.data.img = '1.png'
                    this.$parent.$data.posts.unshift(res.data)
                } else {
                    this.$bvModal.msgBoxOk("an error occured");
                }
            })
            .catch(err => {
                this.$bvModal.msgBoxOk("an error occured")
                this.createForm = "was-validated"
                if (err.response.data) {
                    this.errors = err.response.data.errors
                    // console.log(err.response.data)
                }

            })
            .finally(() => {
                this.saving = false;
            });
    }

    private addTask(): void {
        this.tasks.push({ value: "" });
    }

    public mounted(): void {
        this.addTask();
    }

    private get modalId(): string {
        return this.$props.id;
    }
}
