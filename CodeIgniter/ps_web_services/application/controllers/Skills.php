<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Skills extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');

        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('keyword')) {
            $this->filterSuffix = "?keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }

        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
        $this->table = TBL_SKILLS;
    }

    public function index() {
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/skills/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/skills/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/skills/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = "select * from " . $this->table . " WHERE parent = 0";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (skill_description_en like '%$keyword%')";
        }

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
		//print_r($query);die;
        $data['skills'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);

        $data['title'] = 'Skills | FAZA Admin';
        $data['view'] = 'skills/index';
        $this->load->view('layouts/layout', $data);
    }

    public function sortData() {

        $query = "select * from " . $this->table . " WHERE parent = 0";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (skill_description_en like '%$keyword%')";
        }

        $query.= " AND skill_id >= '" . $this->input->post('startId') . "' AND skill_id <= '" . $this->input->post('endId') . "' order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['skills'] = $this->common_model->customQuery($query, 2);
        $data['postdata'] = $this->input->post();
        $this->load->view("/skills/sortdata", $data);
    }

    public function add() {
        if ($this->input->post('save')) {
//            $check = $this->common_model->isUnique('skill_description', $this->input->post('skill_description'), $this->table);
//            if (!$check) {
            $flag = 0;
            if ($_FILES['image']['name'] != '') {

                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];

//                    $config['upload_path'] = './' . ICON_IMAGES . '/';
                $path = realpath('../HelpYa_WS/skill_icons');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
                $config['min_width'] = '128';
                $config['max_width'] = '128';
                $config['min_height'] = '128';
                $config['max_height'] = '128';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $file_info = $this->upload->data();
                    $userProfile['image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                $data = array(
                    'parent' => 0,
                    'skill_description_en' => $this->input->post('skill_description_en'),
                    'skill_description_ar' => $this->input->post('skill_description_ar'),
                    'skill_description_zh' => $this->input->post('skill_description_zh'),
                     'skill_description_es' => $this->input->post('skill_description_es'),
					'skill_description_fr' => $this->input->post('skill_description_fr'),
                    'img_icon' => $userProfile['image'],
                );
                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'Skill added succesfully');
                redirect('skills');
            } else {
                redirect('skills/add');
            }
//            } else {
//                $this->session->set_flashdata('error', 'Skill name already exist. Please try again.');
//                redirect('skills/add');
//            }
        }
        $data['title'] = 'Add Skill | FAZA Admin';
        $data['view'] = 'skills/add';
        $this->load->view('layouts/layout', $data);
    }

    public function edit($id = NULL) {
        if ($id != '') {
            if ($this->input->post('save')) {
//                $check = $this->common_model->isUnique_skill('skill_description', $this->input->post('skill_description'), $this->table, $id);
//                if (!$check) {
                $flag = 0;
                $image = $this->common_model->getFieldById($id, 'img_icon', $this->table);
                $userData['image'] = $image->img_icon;

                if ($_FILES['image']['name'] != '') {

                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];

//                    $config['upload_path'] = './' . ICON_IMAGES . '/';
                    $path = realpath('../HelpYa_WS/skill_icons');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2048';
                    $config['min_width'] = '128';
                    $config['max_width'] = '128';
                    $config['min_height'] = '128';
                    $config['max_height'] = '128';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $flag = 1;
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        unlink('./' . ICON_IMAGES . '/' . $image->img_icon);

                        $file_info = $this->upload->data();
                        $userData['image'] = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
                    $data = array(
                        'parent' => 0,
                        'skill_description_en' => $this->input->post('skill_description_en'),
                        'skill_description_ar' => $this->input->post('skill_description_ar'),
                        'skill_description_zh' => $this->input->post('skill_description_zh'),
                         'skill_description_es' => $this->input->post('skill_description_es'),
						'skill_description_fr' => $this->input->post('skill_description_fr'),
                        'img_icon' => $userData['image']
                    );
                    $this->common_model->edit_skill($id, $data, $this->table);
                    $this->session->set_flashdata('success', 'Skill updated succesfully');
                    redirect('skills');
                }
//                }
            }
            $data['skill'] = $this->common_model->view_skill($id, $this->table);
            $data['title'] = 'Edit skill | FAZA Admin';
            $data['view'] = 'skills/add';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function delete($id = NULL) {
        if ($id != '') {
            $this->common_model->delete_skill($id, $this->table);
            $this->session->set_flashdata('success', "Skill Deleted Successfully");
//            redirect('users' . $this->suffix);
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function deleteAll() {
        $ids = $this->input->post('ids');
        $idsArr = explode(',', $ids);

        if (count($idsArr) > 1)
            $this->session->set_flashdata('success', "Skill Deleted Successfully");
        else
            $this->session->set_flashdata('success', "Skills Deleted Successfully");
        $this->common_model->deleteMultiple_skills($ids, $this->table);

        exit;
    }

    public function getcategories($id) {

        if ($id != '') {
            $query = "Select * from " . $this->table . " Where parent = '$id'";
            $config = init_pagination1();

            if ($this->input->get('perpage')) {
                $config['per_page'] = $this->input->get('perpage');
                $config['first_url'] = base_url() . "index.php/skills/getcategories/" . $id . $this->perpageSuffix;
            }
            if ($this->input->get('keyword'))
                $config['first_url'] = base_url() . "index.php/skills/getcategories/" . $id . $this->suffix;

            $config['suffix'] = $this->suffix;
            $config['base_url'] = base_url() . "index.php/skills/getcategories/" . $id;
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;


            if ($this->input->get('keyword')) {
                $keyword = $this->input->get('keyword');
                $keyword = str_replace("'", "''", $keyword);
                $query.= " AND (skill_description_en like '%$keyword%')";
            }

            $config['total_rows'] = count($this->common_model->customQuery($query, 2));
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();

            $data['skills'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
            $query_parent = "Select * from " . $this->table . " Where parent = '0' AND skill_id = '$id'";
//            echo $query_parent;
            $data['query_parent'] = $this->common_model->customQuery($query_parent, 1);
//        echo $data['query_parent']->skill_description;exit;

            $data['title'] = 'Categories | FAZA Admin';
            $data['view'] = 'skills/categories';
            $this->load->view('layouts/layout', $data);
//            echo json_encode($data);
//            exit;
        }
    }

    public function getsubcategories($id) {

        if ($id != '') {
            $query = "Select * from " . $this->table . " Where parent = '$id'";

            $config = init_pagination1();

            if ($this->input->get('perpage')) {
                $config['per_page'] = $this->input->get('perpage');
                $config['first_url'] = base_url() . "index.php/skills/getsubcategories/" . $id . $this->perpageSuffix;
            }
            if ($this->input->get('keyword'))
                $config['first_url'] = base_url() . "index.php/skills/getsubcategories/" . $id . $this->suffix;

            $config['suffix'] = $this->suffix;
            $config['base_url'] = base_url() . "index.php/skills/getsubcategories/" . $id;
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            if ($this->input->get('keyword')) {
                $keyword = $this->input->get('keyword');
                $keyword = str_replace("'", "''", $keyword);
                $query.= " AND (skill_description_en like '%$keyword%')";
            }
            $config['total_rows'] = count($this->common_model->customQuery($query, 2));
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['skills'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);

            $query_category = "Select * from " . $this->table . " Where skill_id = '$id'";
            $data['query_category'] = $this->common_model->customQuery($query_category, 1);

            $parent_skill = $data['query_category']->skill_description;
            $query_parent = "Select * from " . $this->table . " Where skill_description_en ='$parent_skill' AND skill_id = '$id'";

            $data['query_parent'] = $this->common_model->customQuery($query_parent, 1);
            $parent_id = $data['query_parent']->parent;

            $query_parent_name = "Select skill_description_en from " . $this->table . " Where skill_id = '$parent_id'";
            $data['query_parent_name'] = $this->common_model->customQuery($query_parent_name, 1);
//        echo $data['query_parent_name']->skill_description;exit;
            $data['title'] = 'Skills | FAZA Admin';
            $data['view'] = 'skills/subcategories';
            $this->load->view('layouts/layout', $data);
        }
    }

    public function getsubsubcategories($id) {

        if ($id != '') {
            $query = "Select * from " . $this->table . " Where parent = '$id'";

            $config = init_pagination1();

            if ($this->input->get('perpage')) {
                $config['per_page'] = $this->input->get('perpage');
                $config['first_url'] = base_url() . "index.php/skills/getsubsubcategories/" . $id . $this->perpageSuffix;
            }
            if ($this->input->get('keyword'))
                $config['first_url'] = base_url() . "index.php/skills/getsubsubcategories/" . $id . $this->suffix;

            $config['suffix'] = $this->suffix;
            $config['base_url'] = base_url() . "index.php/skills/getsubsubcategories/" . $id;
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            if ($this->input->get('keyword')) {
                $keyword = $this->input->get('keyword');
                $keyword = str_replace("'", "''", $keyword);
                $query.= " AND (skill_description_en like '%$keyword%')";
            }
            $config['total_rows'] = count($this->common_model->customQuery($query, 2));
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['skills'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);

            $query_category = "Select * from " . $this->table . " Where skill_id = '$id'";
            $data['query_category'] = $this->common_model->customQuery($query_category, 1);

            $parent_skill = $data['query_category']->skill_description;
            $query_parent = "Select * from " . $this->table . " Where skill_description_en ='$parent_skill' AND skill_id = '$id'";

            $data['query_parent'] = $this->common_model->customQuery($query_parent, 1);
            $parent_id = $data['query_parent']->parent;

            $query_parent_name = "Select * from " . $this->table . " Where skill_id = '$parent_id'";
            $data['query_parent_name'] = $this->common_model->customQuery($query_parent_name, 1);
            $pid = $data['query_parent_name']->parent;

            $query_parent_skill = "Select * from " . $this->table . " Where skill_id = '$pid'";
            $data['query_parent_skill'] = $this->common_model->customQuery($query_parent_skill, 1);

            $data['title'] = 'Skills | FAZA Admin';
            $data['view'] = 'skills/subsubcategories';
            $this->load->view('layouts/layout', $data);
        }
    }

    public function addCategory($parent_id) {
        $query = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query, 1);

        if ($this->input->post('save')) {
//            $check = $this->common_model->isUnique('skill_description', $this->input->post('skill_description'), $this->table);
//            if (!$check) {
            $flag = 0;
            if ($_FILES['image']['name'] != '') {

                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];

//                $config['upload_path'] = './' . ICON_IMAGES . '/';
                $path = realpath('../HelpYa_WS/skill_icons');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
                $config['min_width'] = '128';
                $config['max_width'] = '128';
                $config['min_height'] = '128';
                $config['max_height'] = '128';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $file_info = $this->upload->data();
                    $userProfile['image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                $data = array(
                    'parent' => $this->input->post('parent_id'),
                    'skill_description_en' => $this->input->post('skill_description_en'),
                    'skill_description_ar' => $this->input->post('skill_description_ar'),
                    'skill_description_zh' => $this->input->post('skill_description_zh'),
                     'skill_description_es' => $this->input->post('skill_description_es'),
					'skill_description_fr' => $this->input->post('skill_description_fr'),
                    'img_icon' => $userProfile['image']
                );

                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'Category added succesfully');
                redirect('skills/getcategories/' . $parent_id);
            } else {
                redirect('skills/addCategory/' . $parent_id);
            }
//            } else {
//                $this->session->set_flashdata('error', 'Category name already exist. Please try again.');
//                redirect('skills/addCategory/' . $parent_id);
//            }
        }
        $data['title'] = 'Add Category | FAZA Admin';
        $data['view'] = 'skills/addcategory';
        $this->load->view('layouts/layout', $data);
    }

    public function editCategory($parent_id, $id) {
//        echo $id.'<br>'.$parent_id;
        $query_parent = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query_parent, 1);
        if ($id != '') {
            if ($this->input->post('save')) {
//                $check = $this->common_model->isUnique_skill('skill_description', $this->input->post('skill_description'), $this->table, $id);
//                if (!$check) {
                $flag = 0;
                $image = $this->common_model->getFieldById($id, 'img_icon', $this->table);
                $userData['image'] = $image->img_icon;

                if ($_FILES['image']['name'] != '') {

                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];

//                    $config['upload_path'] = './' . ICON_IMAGES . '/';
                    $path = realpath('../HelpYa_WS/skill_icons');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2048';
                    $config['min_width'] = '128';
                    $config['max_width'] = '128';
                    $config['min_height'] = '128';
                    $config['max_height'] = '128';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $flag = 1;
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        unlink('./' . ICON_IMAGES . '/' . $image->img_icon);

                        $file_info = $this->upload->data();
                        $userData['image'] = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
                    $par = $this->input->post('parent_id');
                    $id1 = $this->input->post('id');
                    $data = array(
                        'parent' => $this->input->post('parent_id'),
                        'skill_description_en' => $this->input->post('skill_description_en'),
                        'skill_description_ar' => $this->input->post('skill_description_ar'),
                        'skill_description_zh' => $this->input->post('skill_description_zh'),
                         'skill_description_es' => $this->input->post('skill_description_es'),
						'skill_description_fr' => $this->input->post('skill_description_fr'),
                        'img_icon' => $userData['image']
                    );

                    $this->common_model->edit_skill($id1, $data, $this->table);
                    $this->session->set_flashdata('success', 'Category updated succesfully');
                    redirect('skills/getcategories/' . $par);
                }
//                }
            }
            $query = "Select * from " . $this->table . " Where skill_id='$id'";
            $data['category'] = $this->common_model->customQuery($query, 1);
            $data['title'] = 'Edit Category | FAZA Admin';
            $data['view'] = 'skills/addcategory';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function addSubCategory($parent_id) {
        $query = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query, 1);

        if ($this->input->post('save')) {
//            $check = $this->common_model->isUnique('skill_description', $this->input->post('skill_description'), $this->table);
//            if (!$check) {
            $flag = 0;
            if ($_FILES['image']['name'] != '') {

                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];

//                $config['upload_path'] = './' . ICON_IMAGES . '/';
                $path = realpath('../HelpYa_WS/skill_icons');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
                $config['min_width'] = '128';
                $config['max_width'] = '128';
                $config['min_height'] = '128';
                $config['max_height'] = '128';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $file_info = $this->upload->data();
                    $userProfile['image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                $data = array(
                    'parent' => $this->input->post('parent_id'),
                    'skill_description_en' => $this->input->post('skill_description_en'),
                    'skill_description_ar' => $this->input->post('skill_description_ar'),
                    'skill_description_zh' => $this->input->post('skill_description_zh'),
                     'skill_description_es' => $this->input->post('skill_description_es'),
					'skill_description_fr' => $this->input->post('skill_description_fr'),
                    'img_icon' => $userProfile['image']
                );

                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'SubCategory added succesfully');
                redirect('skills/getsubcategories/' . $parent_id);
            } else {
                redirect('skills/addSubCategory/' . $parent_id);
            }
//            } else {
//                $this->session->set_flashdata('error', 'SubCategory name already exist. Please try again.');
//                redirect('skills/addSubCategory/' . $parent_id);
//            }
        }

        $parent = $data['parent_name']->parent;
        $query = "Select * from " . $this->table . " Where skill_id='$parent'";
        $data['parent'] = $this->common_model->customQuery($query, 1);

        $data['title'] = 'Add SubCategory | FAZA Admin';
        $data['view'] = 'skills/addsubcategory';
        $this->load->view('layouts/layout', $data);
    }

    public function editSubCategory($parent_id, $id) {
        $query_parent = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query_parent, 1);
        if ($id != '') {
            if ($this->input->post('save')) {
//                $check = $this->common_model->isUnique_skill('skill_description', $this->input->post('skill_description'), $this->table, $id);
//                if (!$check) {
                $flag = 0;
                $image = $this->common_model->getFieldById($id, 'img_icon', $this->table);
                $userData['image'] = $image->img_icon;

                if ($_FILES['image']['name'] != '') {

                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];

//                    $config['upload_path'] = './' . ICON_IMAGES . '/';
                    $path = realpath('../HelpYa_WS/skill_icons');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2048';
                    $config['min_width'] = '128';
                    $config['max_width'] = '128';
                    $config['min_height'] = '128';
                    $config['max_height'] = '128';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $flag = 1;
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        unlink('./' . ICON_IMAGES . '/' . $image->img_icon);

                        $file_info = $this->upload->data();
                        $userData['image'] = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
                    $par = $this->input->post('parent_id');
                    $id1 = $this->input->post('id');
                    $data = array(
                        'parent' => $this->input->post('parent_id'),
                        'skill_description_en' => $this->input->post('skill_description_en'),
                        'skill_description_ar' => $this->input->post('skill_description_ar'),
                        'skill_description_zh' => $this->input->post('skill_description_zh'),
                         'skill_description_es' => $this->input->post('skill_description_es'),
						'skill_description_fr' => $this->input->post('skill_description_fr'),
                        'img_icon' => $userData['image']
                    );
                    $this->common_model->edit_skill($id1, $data, $this->table);
                    $this->session->set_flashdata('success', 'Subcategory updated succesfully');
                    redirect('skills/getsubcategories/' . $par);
                }
//                }
            }
            $query = "Select * from " . $this->table . " Where skill_id='$id'";
            $data['subcategory'] = $this->common_model->customQuery($query, 1);

            $parent = $data['parent_name']->parent;
            $query = "Select * from " . $this->table . " Where skill_id='$parent'";
            $data['parent'] = $this->common_model->customQuery($query, 1);
            $data['title'] = 'Edit Subcategory | FAZA Admin';
            $data['view'] = 'skills/addsubcategory';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function sortDataCategory($id) {

        $query = "select * from " . $this->table . " WHERE parent = '$id'";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (skill_description_en like '%$keyword%')";
        }
        $query.= " AND skill_id >= '" . $this->input->post('startId') . "' AND skill_id <= '" . $this->input->post('endId') . "' order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['skills'] = $this->common_model->customQuery($query, 2);
        $query_parent = "Select * from " . $this->table . " Where parent = '0' AND skill_id = '$id'";
        $data['query_parent'] = $this->common_model->customQuery($query_parent, 1);
        $data['postdata'] = $this->input->post();
        $this->load->view("/skills/sortdatacategory", $data);
    }

    public function sortDataSubcategory($id) {

        $query = "select * from " . $this->table . " WHERE parent = '$id'";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (skill_description_en like '%$keyword%')";
        }
        $query.= " AND skill_id >= '" . $this->input->post('startId') . "' AND skill_id <= '" . $this->input->post('endId') . "' order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['skills'] = $this->common_model->customQuery($query, 2);
        $query_category = "Select * from " . $this->table . " Where skill_id = '$id'";
        $data['query_category'] = $this->common_model->customQuery($query_category, 1);

        $parent_id = $data['query_category']->parent;
        $query_parent_name = "Select skill_description_en from " . $this->table . " Where skill_id = '$parent_id'";
        $data['query_parent_name'] = $this->common_model->customQuery($query_parent_name, 1);
        $data['postdata'] = $this->input->post();
        $this->load->view("/skills/sortdatasubcategory", $data);
    }

    public function view($id = NULL) {
        if ($id != '') {
            $data['skill'] = $this->common_model->view_skill($id, $this->table);
//            pr($data['skill'],1);
            $data['title'] = 'View Skill | FAZA Admin';
            $data['view'] = 'skills/skill_view';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function addSubSubCategory($parent_id) {
        $query = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query, 1);

        if ($this->input->post('save')) {
//            $check = $this->common_model->isUnique('skill_description', $this->input->post('skill_description'), $this->table);
//            if (!$check) {
            $flag = 0;
            if ($_FILES['image']['name'] != '') {

                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];

//                $config['upload_path'] = './' . ICON_IMAGES . '/';
                $path = realpath('../HelpYa_WS/skill_icons');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
                $config['min_width'] = '128';
                $config['max_width'] = '128';
                $config['min_height'] = '128';
                $config['max_height'] = '128';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $file_info = $this->upload->data();
                    $userProfile['image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                $data = array(
                    'parent' => $this->input->post('parent_id'),
                    'skill_description_en' => $this->input->post('skill_description_en'),
                    'skill_description_ar' => $this->input->post('skill_description_ar'),
                    'skill_description_zh' => $this->input->post('skill_description_zh'),
                     'skill_description_es' => $this->input->post('skill_description_es'),
					'skill_description_fr' => $this->input->post('skill_description_fr'),
                    'img_icon' => $userProfile['image']
                );

                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'Sub-subcategory added succesfully');
                redirect('skills/getsubsubcategories/' . $parent_id);
            } else {
                redirect('skills/addSubSubCategory/' . $parent_id);
            }
//            } else {
//                $this->session->set_flashdata('error', 'Sub-subcategory name already exist. Please try again.');
//                redirect('skills/addSubSubCategory/' . $parent_id);
//            }
        }

        $parent = $data['parent_name']->parent;
        $query = "Select * from " . $this->table . " Where skill_id='$parent'";
        $data['parent'] = $this->common_model->customQuery($query, 1);

        $data['title'] = 'Add SubSubCategory | FAZA Admin';
        $data['view'] = 'skills/addSubSubCategory';
        $this->load->view('layouts/layout', $data);
    }

    public function editSubSubCategory($parent_id, $id) {
        $query_parent = "Select * from " . $this->table . " Where skill_id='$parent_id'";
        $data['parent_name'] = $this->common_model->customQuery($query_parent, 1);
        if ($id != '') {
            if ($this->input->post('save')) {
//                $check = $this->common_model->isUnique_skill('skill_description', $this->input->post('skill_description'), $this->table, $id);
//                if (!$check) {
                $flag = 0;
                $image = $this->common_model->getFieldById($id, 'img_icon', $this->table);
                $userData['image'] = $image->img_icon;

                if ($_FILES['image']['name'] != '') {

                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];

//                    $config['upload_path'] = './' . ICON_IMAGES . '/';
                    $path = realpath('../HelpYa_WS/skill_icons');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2048';
                    $config['min_width'] = '128';
                    $config['max_width'] = '128';
                    $config['min_height'] = '128';
                    $config['max_height'] = '128';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $flag = 1;
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        unlink('./' . ICON_IMAGES . '/' . $image->img_icon);

                        $file_info = $this->upload->data();
                        $userData['image'] = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
                    $par = $this->input->post('parent_id');
                    $id1 = $this->input->post('id');
                    $data = array(
                        'parent' => $this->input->post('parent_id'),
                        'skill_description_en' => $this->input->post('skill_description_en'),
                        'skill_description_ar' => $this->input->post('skill_description_ar'),
                        'skill_description_zh' => $this->input->post('skill_description_zh'),
                        'skill_description_es' => $this->input->post('skill_description_es'),
						'skill_description_fr' => $this->input->post('skill_description_fr'),
                        'img_icon' => $userData['image']
                    );
                    $this->common_model->edit_skill($id1, $data, $this->table);
                    $this->session->set_flashdata('success', 'Sub-subCategory updated succesfully');
                    redirect('skills/getsubsubcategories/' . $par);
                }
//                }
            }
            $query = "Select * from " . $this->table . " Where skill_id='$id'";
            $data['subsubcategory'] = $this->common_model->customQuery($query, 1);

            $parent = $data['parent_name']->parent;
            $query = "Select * from " . $this->table . " Where skill_id='$parent'";
            $data['parent'] = $this->common_model->customQuery($query, 1);
            $data['title'] = 'Edit Sub-subcategory | FAZA Admin';
            $data['view'] = 'skills/addSubSubCategory';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function sortDataSubSubcategory($id) {

        $query = "select * from " . $this->table . " WHERE parent = '$id'";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (skill_description_en like '%$keyword%')";
        }
        $query.= " AND skill_id >= '" . $this->input->post('startId') . "' AND skill_id <= '" . $this->input->post('endId') . "' order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['skills'] = $this->common_model->customQuery($query, 2);
        $query_category = "Select * from " . $this->table . " Where skill_id = '$id'";
        $data['query_category'] = $this->common_model->customQuery($query_category, 1);

        $parent_id = $data['query_category']->parent;
        $query_parent_name = "Select * from " . $this->table . " Where skill_id = '$parent_id'";
        $data['query_parent_name'] = $this->common_model->customQuery($query_parent_name, 1);

        $pid = $data['query_parent_name']->parent;

        $query_parent_skill = "Select * from " . $this->table . " Where skill_id = '$pid'";
        $data['query_parent_skill'] = $this->common_model->customQuery($query_parent_skill, 1);

        $data['postdata'] = $this->input->post();
        $this->load->view("/skills/sortdatasubsubcategory", $data);
    }

}
