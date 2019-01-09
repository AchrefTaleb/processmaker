import Vue from 'vue'
import TaskForm from './components/TaskForm'
import TaskView from './components/TaskView'
import AvatarImage from '../components/AvatarImage'
import TaskReassign from './components/TaskReassign'

Vue.component('task-screen', TaskForm);
Vue.component('task-view', TaskView);
Vue.component('avatar-image', AvatarImage);
Vue.component('task-reassign', TaskReassign);
