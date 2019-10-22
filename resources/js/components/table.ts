import {Vue, Component} from './vue'


interface Student
{
    name: string
    dept: string
    height: number
}

@Component({
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    template: `
    <table class='table bordered table-striped shadow>
        <thead>
            <tr>
                <th v-on:click='ByName()' v-bind:class='order === "name" ? "bg-primary text-light" : ""'>Name</th>
                <th v-on:click='ByDept()' v-bind:class="order === 'dept' ? 'bg-success text-light' : ''">Dept</th>
                <th v-on:click='ByHeight()' v-bind:class='order === "height" ? "bg-danger text-light" : ""'>Height</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for='s in students'>
                <td>{{ s.name.substr(0, 12) }}</td>
                <td>{{ s.dept }}</td>
                <td>{{ s.height }}</td>
            </tr>
        </tbody>
    </table>
    `
})
export default class Table extends Vue
{
    public students: Array<Student>;
    public order: string = 'any';

    private ByName() : void
    {
        this.students.sort((s1, s2) => parseFloat(s1.name.substr(3, 9)) - parseFloat(s2.name.substr(3, 9)))
        this.order = 'name'
    }

    private ByDept() : void {
        this.students.sort((s1, s2) => s1.dept.charCodeAt(0) - s2.dept.charCodeAt(0))
        this.order = 'dept'
    }

    private ByHeight() : void {
        this.students.sort((s1, s2) => s1.height - s2.height)
        this.order = 'height'
    }
}