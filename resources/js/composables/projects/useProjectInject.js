import { inject } from "vue";
import { projectKey } from "./keys";

export function useProjectInject() {
    const project = inject(projectKey);

    if (!project) {
        throw new Error("Publication não foi provido");
    }

    return project;
}
