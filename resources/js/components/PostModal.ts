import { Vue, Component } from "./vue";
import Axios from "axios";

@Component({
    props: {
        id: String
    },
    template: require("./post-modal.html")
})
export default class PostModal extends Vue {
    public createForm: string = "";
    private ptitle: string = "";
    private body: string = "";
    private tasks: Array<{ value: string }> = [];
    private saving = false;

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

        Axios.post("/api/posts", {
            title: this.ptitle,
            body: this.body,
            tasks: JSON.stringify(this.tasks)
        })
            .then(res => {
                console.log(res);
                if (res.status === 201) {
                    this.$bvModal.msgBoxOk("post successfully created");
                    this.$bvModal.hide("post-form");
                    this.ptitle = this.body = ""
                } else {
                    this.$bvModal.msgBoxOk("an error occured");
                }
            })
            .catch(err => {
                this.$bvModal.msgBoxOk("an error occured");
                this.createForm = "was-validated";
                console.log(err);
            })
            .finally(() => {
                this.saving = false;
            });
    }

    private addTask(): void {
        this.tasks.push({ value: "" });
    }

    public mounted(): void {
        // console.log("mounted now");
        this.addTask();
    }

    private get modalId(): string {
        return this.$props.id;
    }
}
