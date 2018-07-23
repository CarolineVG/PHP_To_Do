<?php

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 

/** header */
include_once("header.php"); 
?>

<div class="login">
<form method="post">
<h2>Join A Project</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="form-group">
            <div class="projectDropdown">
                        <select class="form-control" id="projects" name="projects">
                            <option>Choose project </option>
                            <?php
                            // show projects
                            $project = new Project();
                            $project->showAllProjectsInDropdown();
                            ?>
                        </select>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" name="submit">Join Project</button>
                        </div>
                    </div>
            </div>
    </form>
</div>
    
<?php 
/** footer */
include_once("footer.php"); 
?>