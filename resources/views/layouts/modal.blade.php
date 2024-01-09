      <!-- Modal: Create project -->
      <div class="modal fade" id="CreateNew" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
           <div class="modal-content rounded-0">
              <div class="modal-header">
                 <h5 class="modal-title">Setup new project</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="progress bg-transparent" style="height: 3px;">
                 <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 20%;"></div>
              </div>
              <div class="modal-body custom_scroll">
                 <ul class="nav nav-tabs tab-card border-0 fs-6" role="tablist">
                    <li class="nav-item flex-fill text-center"><a class="nav-link active" href="#step1" data-bs-toggle="tab" data-bs-step="1">1. Project</a></li>
                    <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step2" data-bs-toggle="tab" data-bs-step="3">2. Team</a></li>
                    <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step3" data-bs-toggle="tab" data-bs-step="4">3. File</a></li>
                    <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step4" data-bs-toggle="tab" data-bs-step="5">4. Completed</a></li>
                 </ul>
                 <div class="tab-content">
                    <div class="tab-pane fade show active" id="step1">
                       <div class="card mb-2">
                          <div class="card-body">
                             <h6 class="card-title mb-1">Project Type</h6>
                             <p class="text-muted small">If you need more info, please check out <a href="#">FAQ Page</a></p>
                             <!-- Custome redio input -->
                             <div class="c_radio d-flex flex-md-wrap">
                                <label class="m-1 w-100" for="Personal">
                                   <input type="radio" name="plan" id="Personal" checked />
                                   <span class="card">
                                      <span class="card-body d-flex p-3">
                                         <svg class="avatar" viewBox="0 0 16 16">
                                            <path class="fill-muted" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                         </svg>
                                         <span class="ms-3">
                                         <span class="h6 d-flex mb-1">Personal Project</span>
                                         <span class="text-muted">For smaller business, with simple salaries and pay schedules.</span>
                                         </span>
                                      </span>
                                   </span>
                                </label>
                                <label class="m-1 w-100" for="Team">
                                   <input type="radio" name="plan" id="Team"/>
                                   <span class="card">
                                      <span class="card-body d-flex p-3">
                                         <svg class="avatar" viewBox="0 0 16 16">
                                            <path class="fill-muted" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            <path class="fill-muted" fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                            <path class="fill-muted" d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                         </svg>
                                         <span class="ms-3">
                                         <span class="h6 d-flex mb-1">Team Project</span>
                                         <span class="text-muted">For growing business who wants to create a rewarding place to work.</span>
                                         </span>
                                      </span>
                                   </span>
                                </label>
                             </div>
                          </div>
                       </div>
                       <div class="card mb-2">
                          <div class="card-body">
                             <h6 class="card-title mb-1">Project Details</h6>
                             <p class="text-muted small">It is a long established fact that a reader will be distracted by Luno.</p>
                             <div class="form-floating mb-2">
                                <select class="form-select">
                                   <option selected>Open this select menu</option>
                                   <option value="1">Lucid</option>
                                   <option value="2">LUNO</option>
                                   <option value="3">Luno</option>
                                </select>
                                <label>Choose a Customer *</label>
                             </div>
                             <div class="form-floating mb-2">
                                <input type="text" class="form-control" placeholder="Project name">
                                <label>Project name *</label>
                             </div>
                             <div class="form-floating mb-2">
                                <textarea class="form-control" placeholder="Add project details" style="height: 100px"></textarea>
                                <label>Add project details</label>
                             </div>
                             <div class="form-floating mb-2">
                                <input type="date" class="form-control">
                                <label>Enter release Date *</label>
                             </div>
                             <div class="d-flex justify-content-between">
                                <div class="text-muted">Allow Notifications *</div>
                                <div>
                                   <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="allow_phone" value="option1">
                                      <label class="form-check-label" for="allow_phone">Phone</label>
                                   </div>
                                   <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="allow_email" value="option2">
                                      <label class="form-check-label" for="allow_email">Email</label>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="text-center">
                          <button class="btn btn-lg bg-secondary text-light next text-uppercase">Add People</button>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="step2">
                       <div class="card mb-3">
                          <div class="card-body">
                             <h6 class="card-title mb-1">Build a Team</h6>
                             <p class="text-muted small">If you need more info, please check out <a href="#">Project Guidelines</a></p>
                             <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Invite Teammates">
                                <label>Invite Teammates</label>
                             </div>
                             <h6 class="card-title mb-1">Team Members</h6>
                             <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="list-group6" checked="">
                                <label class="form-check-label text-muted" for="list-group6">Adding Users by Team Members</label>
                             </div>
                          </div>
                          <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0" style="height: 300px;">
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar1.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">Angular Developer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar2.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Joge Lucky</div>
                                   <small class="text-muted">ReactJs Developer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar3.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">NodeJs Developer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar4.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">Sr. Designer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar5.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">Designer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar6.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">Front-End Developer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar7.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">QA</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                             <li class="list-group-item d-flex align-items-center">
                                <img class="avatar rounded" src="assets/images/xs/avatar8.jpg" alt="">
                                <div class="flex-fill ms-2">
                                   <div class="h6 mb-0">Chris Fox</div>
                                   <small class="text-muted">Laravel Developer</small>
                                </div>
                                <select class="form-select rounded-pill form-select-sm w120">
                                   <option value="1">Owner</option>
                                   <option value="2">Can Edit</option>
                                   <option value="3">Guest</option>
                                </select>
                             </li>
                          </ul>
                       </div>
                       <div class="text-center">
                          <button class="btn btn-lg bg-secondary text-light next text-uppercase">Select Files</button>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="step3">
                       <div class="card mb-3">
                          <div class="card-body">
                             <h6 class="card-title mb-1">Upload Files</h6>
                             <div class="mb-4">
                                <label class="form-label small">Upload up to 10 files</label>
                                <input class="form-control" type="file" multiple>
                             </div>
                             <span>Already Uploaded File</span>
                          </div>
                          <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0" style="height: 300px;">
                             <li class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                   <div class="avatar rounded no-thumbnail"><i class="fa fa-file-pdf-o text-danger"></i></div>
                                   <div class="flex-fill ms-3 text-truncate">
                                      <p class="mb-0 color-800">Annual Sales Report 2018-19</p>
                                      <small class="text-muted">.pdf, 5.3 MB</small>
                                   </div>
                                </div>
                             </li>
                             <li class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                   <div class="avatar rounded no-thumbnail"><i class="fa fa-file-excel-o text-success"></i></div>
                                   <div class="flex-fill ms-3 text-truncate">
                                      <p class="mb-0 color-800">Complete Product Sheet</p>
                                      <small class="text-muted">.xls, 2.1 MB</small>
                                   </div>
                                </div>
                             </li>
                             <li class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                   <div class="avatar rounded no-thumbnail"><i class="fa fa-file-word-o text-info"></i></div>
                                   <div class="flex-fill ms-3 text-truncate">
                                      <p class="mb-0 color-800">Marketing Guidelines</p>
                                      <small class="text-muted">.doc, 2.3 MB</small>
                                   </div>
                                </div>
                             </li>
                             <li class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                   <div class="avatar rounded no-thumbnail"><i class="fa fa-file-zip-o"></i></div>
                                   <div class="flex-fill ms-3 text-truncate">
                                      <p class="mb-0 color-800">Brand Photography</p>
                                      <small class="text-muted">.zip, 30.5 MB</small>
                                   </div>
                                </div>
                             </li>
                          </ul>
                       </div>
                       <div class="text-center">
                          <button class="btn btn-lg bg-secondary text-light next text-uppercase">Advanced Options</button>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="step4">
                       <div class="card text-center">
                          <div class="card-body">
                             <h4 class="card-title mb-1">Project Created!</h4>
                             <span class="text-muted">If you need more info, please check how to create project</span>
                          </div>
                          <div class="card-body">
                             <button class="btn btn-lg bg-light first text-uppercase">Cretae new project</button>
                             <button class="btn btn-lg bg-secondary text-light text-uppercase">View project</button>
                          </div>
                          <div class="card-body">
                             <img class="img-fluid" src="assets/images/project-team.svg" alt="" />
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- Modal: Schedule -->
     <div class="modal fade" id="ScheduleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
           <div class="modal-content">
              <div class="modal-header bg-secondary rounded-0">
                 <h5 class="modal-title text-light">Schedule</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body custom_scroll">
                 <div class="ps-2">
                    <!--Timeline item-->
                    <div class="timeline-item ti-primary p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-phone"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Call Danny at Colby's</div>
                          <small class="text-muted">Today - 11:32am</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-info p-3">
                       <div class="timeline-icon">
                          <img class="avatar sm rounded-circle" src="assets/images/xs/avatar1.jpg" alt="">
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Meeting with Alice</div>
                          <small class="text-muted">Today - 12:50pm</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-danger p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-comment"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Answer Annie's message</div>
                          <small class="text-muted">Today - 01:35pm</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-danger p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-phone"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Send new campaign</div>
                          <small class="text-muted">Today - 02:40pm</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-primary p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-smile-o"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Project review</div>
                          <small class="text-muted">Today - 03:15pm</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-warning p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-phone"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Call Trisha Jackson</div>
                          <small class="text-muted">Today - 05:40pm</small>
                       </div>
                    </div>
                    <!--Timeline item-->
                    <div class="timeline-item ti-success p-3">
                       <div class="avatar sm rounded-circle no-thumbnail">
                          <i class="fa fa-leaf"></i>
                       </div>
                       <div class="timeline-content ms-3">
                          <div>Write proposal for Don</div>
                          <small class="text-muted">Today - 06:30pm</small>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- Modal: my notes -->
     <div class="modal fade" id="MynotesModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
           <div class="modal-content">
              <div class="modal-header px-4">
                 <h5 class="modal-title">My Notes <span class="badge bg-danger ms-2">14</span></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="bg-light px-4 py-3">
                 <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                       <a class="nav-link active" data-bs-toggle="tab" href="#Notetab-all" role="tab" aria-selected="true">All Notes</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" data-bs-toggle="tab" href="#Notetab-Business" role="tab" aria-selected="false">Business</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" data-bs-toggle="tab" href="#Notetab-Social" role="tab">Social</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" data-bs-toggle="tab" href="#Notetab-Create" role="tab"><i class="fa fa-plus me-2"></i>New</a>
                    </li>
                 </ul>
              </div>
              <div class="modal-body px-4 custom_scroll">
                 <div class="tab-content p-0">
                    <div class="tab-pane fade active show" id="Notetab-all" role="tabpanel">
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-primary position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">02 January 2021</span>
                             <p class="lead">Give Review for design</p>
                             <span>It has roots in a piece of classical Latin literature from 45 BC, making it over 2020 years old.</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-success position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">17 January 2022</span>
                             <p class="lead">Give salary to employee</p>
                             <span>The generated Lorem Ipsum is therefore always free from repetition</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-info position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">02 Fabruary 2020</span>
                             <p class="lead">Launch new template</p>
                             <span>Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-dark position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">22 August 2021</span>
                             <p class="lead">Nightout with friends</p>
                             <span>Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-danger position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">01 December 2021</span>
                             <p class="lead">Change a Design</p>
                             <span> It has survived not only five centuries, but also the leap into electronic</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-warning position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">10 December 2021</span>
                             <p class="lead">Meeting with Mr.Lee</p>
                             <span>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="Notetab-Business" role="tabpanel">
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-warning position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">10 December 2021</span>
                             <p class="lead">Meeting with Mr.Lee</p>
                             <span>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-danger position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">01 December 2021</span>
                             <p class="lead">Change a Design</p>
                             <span> It has survived not only five centuries, but also the leap into electronic</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="Notetab-Social" role="tabpanel">
                       <div class="card ribbon mb-2">
                          <div class="option-2 bg-dark position-absolute"></div>
                          <div class="card-body">
                             <span class="text-muted">22 August 2021</span>
                             <p class="lead">Nightout with friends</p>
                             <span>Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</span>
                          </div>
                          <div class="card-footer pt-0 border-0">
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-star favourite-note"></i></a>
                             <a class="btn btn-sm btn-outline-secondary" href="#"><i class="fa fa-trash favourite-note"></i></a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="Notetab-Create" role="tabpanel">
                       <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Note Title">
                          <label>Note Title</label>
                       </div>
                       <div class="form-floating mb-2">
                          <input type="text" class="form-control datepicker" placeholder="Select Date">
                          <label>Select Date</label>
                       </div>
                       <div class="form-floating mb-2">
                          <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                             <option selected>Open this select menu</option>
                             <option value="1">Business</option>
                             <option value="2">Social</option>
                          </select>
                          <label>Works with selects</label>
                       </div>
                       <div class="form-floating mb-4">
                          <textarea class="form-control" placeholder="Leave a comment here" style="height: 100px"></textarea>
                          <label>Leave a comment here</label>
                       </div>
                       <button type="button" class="btn btn-primary lift">Save note</button>
                       <button type="button" class="btn btn-white border lift" data-bs-dismiss="modal">Close</button>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- Modal: RecentChat -->
     <div class="modal fade" id="RecentChat" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
           <div class="modal-content">
              <div class="d-flex align-items-start">
                 <div class="nav flex-column nav-pills p-3 h-100">
                    <a class="nav-link rounded-circle p-1 mb-2 active" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar1.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar2.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar3.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar4.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-5" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar5.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar6.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-7" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar7.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar8.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar9.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar10.jpg" alt="avatar">
                    </a>
                    <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                    <img class="avatar sm rounded-circle border" src="assets/images/xs/avatar5.jpg" alt="avatar">
                    </a>
                 </div>
                 <div class="tab-content shadow-sm">
                    <div class="tab-pane fade show active" id="c-user-1" role="tabpanel">
                       <div class="card border-0">
                          <!-- start: chat header -->
                          <div class="card-header border-bottom py-3">
                             <div class="d-flex">
                                <a href="javascript:void(0);" title="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar1.jpg" alt="avatar">
                                </a>
                                <div class="ms-3">
                                   <h6 class="mb-0">Orlando Lentz</h6>
                                   <small class="text-muted">Last seen: 2 hours ago</small>
                                </div>
                             </div>
                             <div class="dropdown morphing scale-left">
                                <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                                <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                                <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                <ul class="dropdown-menu shadow border-0 p-2">
                                   <li><a class="dropdown-item" href="#">File Info</a></li>
                                   <li><a class="dropdown-item" href="#">Copy to</a></li>
                                   <li><a class="dropdown-item" href="#">Move to</a></li>
                                   <li><a class="dropdown-item" href="#">Rename</a></li>
                                   <li><a class="dropdown-item" href="#">Block</a></li>
                                   <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                             </div>
                          </div>
                          <!-- start: chat body -->
                          <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                             <ul class="list-unstyled chat-history flex-grow-1">
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar1.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> Hi Aiden, how are you?</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Are we meeting today?</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar1.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar1.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar1.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message">
                                            <p>Please find attached images</p>
                                            <img class="w120 img-thumbnail" src="assets/images/gallery/3.jpg" alt="">
                                            <img class="w120 img-thumbnail" src="assets/images/gallery/4.jpg" alt="">
                                         </div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Okay, will check and let you know.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                             </ul>
                          </div>
                          <!-- start: chat footer -->
                          <div class="card-footer border-top bg-transparent py-3 px-4">
                             <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter text here...">
                                <button class="btn btn-primary" type="button">Send</button>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade show active" id="c-user-2" role="tabpanel">
                       <div class="card border-0">
                          <!-- start: chat header -->
                          <div class="card-header border-bottom py-3">
                             <div class="d-flex">
                                <a href="javascript:void(0);" title="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar2.jpg" alt="avatar">
                                </a>
                                <div class="ms-3">
                                   <h6 class="mb-0">Orlando Lentz</h6>
                                   <small class="text-muted">Last seen: 2 hours ago</small>
                                </div>
                             </div>
                             <div class="dropdown morphing scale-left">
                                <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                                <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                                <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                <ul class="dropdown-menu shadow border-0 p-2">
                                   <li><a class="dropdown-item" href="#">File Info</a></li>
                                   <li><a class="dropdown-item" href="#">Copy to</a></li>
                                   <li><a class="dropdown-item" href="#">Move to</a></li>
                                   <li><a class="dropdown-item" href="#">Rename</a></li>
                                   <li><a class="dropdown-item" href="#">Block</a></li>
                                   <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                             </div>
                          </div>
                          <!-- start: chat body -->
                          <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                             <ul class="list-unstyled chat-history flex-grow-1">
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Are we meeting today?</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar2.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> Hi Aiden, how are you?</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar2.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message">
                                            <p>Please find attached images</p>
                                            <img class="w120 img-thumbnail" src="assets/images/gallery/1.jpg" alt="">
                                            <img class="w120 img-thumbnail" src="assets/images/gallery/2.jpg" alt="">
                                         </div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: right -->
                                <li class="mb-3 d-flex flex-row-reverse align-items-end">
                                   <div class="max-width-70 text-end">
                                      <div class="user-info mb-1">
                                         <span class="text-muted small">10:12 AM, Today</span>
                                      </div>
                                      <div class="card border-0 p-3 bg-primary text-light">
                                         <div class="message">Okay, will check and let you know.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar2.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                                <!-- Chat: left -->
                                <li class="mb-3 d-flex flex-row align-items-end">
                                   <div class="max-width-70">
                                      <div class="user-info mb-1">
                                         <img class="avatar xs rounded-circle me-1" src="assets/images/xs/avatar2.jpg" alt="avatar">
                                         <span class="text-muted small">10:10 AM, Today</span>
                                      </div>
                                      <div class="card p-3">
                                         <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                                      </div>
                                   </div>
                                   <!-- More option -->
                                   <div class="btn-group">
                                      <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                      <ul class="dropdown-menu rounded-4 border-0 shadow">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Share</a></li>
                                         <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                   </div>
                                </li>
                             </ul>
                          </div>
                          <!-- start: chat footer -->
                          <div class="card-footer border-top bg-transparent py-3 px-4">
                             <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter text here...">
                                <button class="btn btn-primary" type="button">Send</button>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- Modal: Setting -->
     <div class="modal fade" id="SettingsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
           <div class="modal-content">
              <div class="px-xl-4 modal-header">
                 <h5 class="modal-title">Theme Setting</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="px-xl-4 modal-body custom_scroll">
                 <!-- start: color setting -->
                 <div class="card fieldset border border-primary p-3 setting-theme mb-4">
                    <span class="fieldset-tile text-primary bg-card">Color Settings</span>
                    <ul class="list-unstyled d-flex choose-skin mb-0">
                       <li data-theme="black">
                          <div class="black"></div>
                       </li>
                       <li data-theme="indigo">
                          <div class="indigo"></div>
                       </li>
                       <li data-theme="blue" class="active">
                          <div class="blue"></div>
                       </li>
                       <li data-theme="cyan">
                          <div class="cyan"></div>
                       </li>
                       <li data-theme="green">
                          <div class="green"></div>
                       </li>
                       <li data-theme="orange">
                          <div class="orange"></div>
                       </li>
                       <li data-theme="blush">
                          <div class="blush"></div>
                       </li>
                       <li data-theme="red">
                          <div class="red"></div>
                       </li>
                       <li data-theme="dynamic">
                          <div class="dynamic"><i class="fa fa-paint-brush"></i></div>
                       </li>
                    </ul>
                    <!-- Settings: Theme dynamics -->
                    <div class="card fieldset border border-primary p-3 dt-setting mt-4">
                       <span class="fieldset-tile text-primary bg-card">Dynamic Color Settings</span>
                       <div class="row g-3">
                          <div class="col-6">
                             <ul class="list-unstyled mb-0">
                                <li>
                                   <button id="primaryColorPicker" class="btn bg-primary avatar xs me-2"></button>
                                   <label>Primary Color</label>
                                </li>
                                <li>
                                   <button id="secondaryColorPicker" class="btn bg-secondary avatar xs me-2"></button>
                                   <label>Secondary Color</label>
                                </li>
                                <li>
                                   <button id="BodyColorPicker" class="btn btn-outline-secondary bg-body avatar xs me-2"></button>
                                   <label>Site Background</label>
                                </li>
                                <li>
                                   <button id="CardColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                                   <label>Widget Background</label>
                                </li>
                                <li>
                                   <button id="BorderColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                                   <label>Border Color</label>
                                </li>
                             </ul>
                          </div>
                          <div class="col-6">
                             <ul class="list-unstyled mb-0">
                                <li>
                                   <button id="chartColorPicker1" class="btn chart-color1 avatar xs me-2"></button>
                                   <label>Chart Color 1</label>
                                </li>
                                <li>
                                   <button id="chartColorPicker2" class="btn chart-color2 avatar xs me-2"></button>
                                   <label>Chart Color 2</label>
                                </li>
                                <li>
                                   <button id="chartColorPicker3" class="btn chart-color3 avatar xs me-2"></button>
                                   <label>Chart Color 3</label>
                                </li>
                                <li>
                                   <button id="chartColorPicker4" class="btn chart-color4 avatar xs me-2"></button>
                                   <label>Chart Color 4</label>
                                </li>
                                <li>
                                   <button id="chartColorPicker5" class="btn chart-color5 avatar xs me-2"></button>
                                   <label>Chart Color 5</label>
                                </li>
                             </ul>
                          </div>
                       </div>
                    </div>
                 </div>
                 <!-- start: Light/dark -->
                 <div class="card fieldset border setting-mode mb-4">
                    <span class="fieldset-tile bg-card">Light/Dark & Contrast Layout</span>
                    <div class="c_radio d-flex text-center">
                       <label class="m-1 theme-switch" for="theme-switch">
                       <input type="checkbox" id="theme-switch" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/dark-version.svg" alt="Dark Mode" />
                       </span>
                       </label>
                       <label class="m-1 theme-dark" for="theme-dark">
                       <input type="checkbox" id="theme-dark" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/dark-theme.svg" alt="Theme Dark Mode" />
                       </span>
                       </label>
                       <label class="m-1 theme-high-contrast" for="theme-high-contrast">
                       <input type="checkbox" id="theme-high-contrast"/>
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/high-version.svg" alt="High Contrast" />
                       </span>
                       </label>
                       <label class="m-1 theme-rtl" for="theme-rtl">
                       <input type="checkbox" id="theme-rtl"/>
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/rtl-version.svg" alt="RTL Mode!" />
                       </span>
                       </label>
                    </div>
                 </div>
                 <!-- start: Font setting -->
                 <div class="card fieldset border setting-font mb-4">
                    <span class="fieldset-tile bg-card">Google Font Settings</span>
                    <div class="c_radio d-flex text-center font_setting">
                       <label class="m-1" for="font-opensans">
                       <input type="radio" name="font" id="font-opensans" value="font-opensans" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/font-opensans.svg" alt="Dark Mode" />
                       </span>
                       </label>
                       <label class="m-1" for="font-quicksand">
                       <input type="radio" name="font" id="font-quicksand" value="font-quicksand" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/font-quicksand.svg" alt="Dark Mode" />
                       </span>
                       </label>
                       <label class="m-1" for="font-nunito">
                       <input type="radio" name="font" id="font-nunito" value="font-nunito" checked="" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/font-nunito.svg" alt="Dark Mode" />
                       </span>
                       </label>
                       <label class="m-1" for="font-raleway">
                       <input type="radio" name="font" id="font-raleway" value="font-raleway" />
                       <span class="card p-2">
                       <img class="img-fluid" src="assets/images/font-raleway.svg" alt="Dark Mode" />
                       </span>
                       </label>
                    </div>
                 </div>
                 <!-- start: Extra setting -->
                 <div class="setting-more mb-4">
                    <h6 class="card-title">More Setting</h6>
                    <ul class="list-group list-group-flush list-group-custom fs-6">
                       <!-- Settings: Horizontal menu version -->
                       <li class="list-group-item">
                          <div class="form-check form-switch h-menu-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="h_menu">
                             <label class="form-check-label" for="h_menu">Horizontal Menu Version</label>
                          </div>
                       </li>
                       <!-- Settings: page header top Fix -->
                       <li class="list-group-item">
                          <div class="form-check form-switch pageheader-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="PageHeader" checked>
                             <label class="form-check-label" for="PageHeader">Page Header Fix</label>
                          </div>
                       </li>
                       <!-- Settings: page header Dark version  -->
                       <li class="list-group-item">
                          <div class="form-check form-switch pageheader-dark-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="PageHeader_dark">
                             <label class="form-check-label" for="PageHeader_dark">Page Header Dark Mode</label>
                          </div>
                       </li>
                       <!-- Settings: Border radius -->
                       <li class="list-group-item">
                          <div class="form-check form-switch radius-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="BorderRadius">
                             <label class="form-check-label" for="BorderRadius">Border Radius none</label>
                          </div>
                       </li>
                       <!-- Settings: sidebar dark -->
                       <li class="list-group-item">
                          <div class="form-check form-switch sidebardark-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="SidebarDark">
                             <label class="form-check-label" for="SidebarDark">Enable Dark! ( Sidebar )</label>
                          </div>
                       </li>
                       <!-- Settings: Sidebar bg image -->
                       <li class="list-group-item">
                          <div class="setting-img">
                             <div class="form-check form-switch imagebg-switch mb-1">
                                <input class="form-check-input" type="checkbox" id="CheckImage">
                                <label class="form-check-label" for="CheckImage">Background Image (Sidebar)</label>
                             </div>
                             <div class="bg-images">
                                <ul class="list-unstyled d-flex">
                                   <li class="sidebar-img-1 me-1 sidebar-img-active"><a class="rounded sidebar-img" id="img-1" href="#"><img src="assets/images/sidebar-bg/sidebar-1.jpg" alt="" /></a></li>
                                   <li class="sidebar-img-2 me-1"><a class="rounded sidebar-img" id="img-2" href="#"><img src="assets/images/sidebar-bg/sidebar-2.jpg" alt="" /></a></li>
                                   <li class="sidebar-img-3 me-1"><a class="rounded sidebar-img" id="img-3" href="#"><img src="assets/images/sidebar-bg/sidebar-3.jpg" alt="" /></a></li>
                                   <li class="sidebar-img-4 me-1"><a class="rounded sidebar-img" id="img-4" href="#"><img src="assets/images/sidebar-bg/sidebar-4.jpg" alt="" /></a></li>
                                   <li class="sidebar-img-5 me-1"><a class="rounded sidebar-img" id="img-5" href="#"><img src="assets/images/sidebar-bg/sidebar-5.jpg" alt="" /></a></li>
                                </ul>
                             </div>
                          </div>
                       </li>
                       <!-- Settings: Container Fluid -->
                       <li class="list-group-item">
                          <div class="form-check form-switch fluid-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="fluidLayout" checked="">
                             <label class="form-check-label" for="fluidLayout">Container Fluid</label>
                          </div>
                       </li>
                       <!-- Settings: Card box shadow  -->
                       <li class="list-group-item">
                          <div class="form-check form-switch shadow-switch mb-1">
                             <input class="form-check-input" type="checkbox" id="card_shadow">
                             <label class="form-check-label" for="card_shadow">Card Box-Shadow</label>
                          </div>
                       </li>
                    </ul>
                 </div>
              </div>
              <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
                 <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
                 <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
              </div>
           </div>
        </div>
     </div>