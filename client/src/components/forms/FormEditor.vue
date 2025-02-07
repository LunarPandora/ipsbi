<script setup>
    import 'survey-core/defaultV2.min.css'
    import "survey-creator-core/survey-creator-core.min.css"

    import { SurveyCreatorModel } from "survey-creator-core"
    import { SurveyCreatorComponent } from 'survey-creator-vue'

    const creatorOptions = {
        showLogicTab: true,
        isAutoSave: true,

        showDesignerTab: true,
        showTestSurveyTab: true,
        showLogicTab: false,
        showTranslationTab: false,
        showJSONEditorTab: false,
        showThemeTab: false
    };

    const creator = new SurveyCreatorModel(creatorOptions)
</script>

<template>
    <div class="w-2/3 h-[70vh]">
        <SurveyCreatorComponent :model="creator" />
    </div>
</template>