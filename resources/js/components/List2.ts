import Vue, { VNode } from "vue";
import Component from "vue-class-component";

@Component({
    template: `
        <ul>
            <li v-for="i in list" @click="onClick(i)">{{ i }}</li>
            <li>{{ name }}</li>
        </ul>
    `
})
export default class List2 extends Vue {
    private msg: string = "some thing";

    list: Array<string> = ["some", "ahm", "ads", "no here", "dead"];

    private onClick(name: string): void {
        alert(this.msg + " " + name);
    }
}