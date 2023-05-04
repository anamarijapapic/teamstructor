<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Project;
use App\Models\Team;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// [Team] > Projects
Breadcrumbs::for('projects', function (BreadcrumbTrail $trail, Team $team) {
    $trail->push($team->name, route('teams.show', $team));
    $trail->push(__('Projects'), route('teams.projects', $team));
});

// [Team] > Projects > [Project]
Breadcrumbs::for('project', function (BreadcrumbTrail $trail, Team $team, Project $project) {
    $trail->parent('projects', $team);
    $trail->push($project->name, route('teams.projects.discussion', [$team, $project]));
});

// [Team] > Projects > [Project] > Resources
Breadcrumbs::for('resources', function (BreadcrumbTrail $trail, Team $team, Project $project) {
    $trail->parent('project', $team, $project);
    $trail->push(__('Resources'), route('teams.projects.resources', [$team, $project]));
});
