<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 自动排课算法
 * @author Shawn Sun <ershawnsun@gmail.com>
 * @version 1.0.0.1213
 */
class IndexController extends Controller
{

    public function __construct()
    {
        /*
         * 获取所有的学科（有穷值）
         */
        $this->subjects = ['语文', '数学', '英语', '物理', '化学', '生物', '历史', '地理', '政治'];

        /*
         * 获取所有任课教师以及该教师的任课状态和任课学科(有穷值)
         * 任课状态[1正常0冲突]
         */
        $this->teachers = [
            [
                'name' => 't1',
                'status' => 1,
                'subj' => $this->subjects[0]
            ],
            [
                'name' => 't2',
                'status' => 1,
                'subj' => $this->subjects[1]
            ],
            [
                'name' => 't3',
                'status' => 1,
                'subj' => $this->subjects[2]
            ],
            [
                'name' => 't4',
                'status' => 1,
                'subj' => $this->subjects[3]
            ],
            [
                'name' => 't5',
                'status' => 1,
                'subj' => $this->subjects[4]
            ],
            [
                'name' => 't6',
                'status' => 1,
                'subj' => $this->subjects[5]
            ],
            [
                'name' => 't7',
                'status' => 1,
                'subj' => $this->subjects[6]
            ],
            [
                'name' => 't8',
                'status' => 1,
                'subj' => $this->subjects[7]
            ],
            [
                'name' => 't9',
                'status' => 1,
                'subj' => $this->subjects[8]
            ],
        ];
    }

    public function index()
    {
        // 限制该学科本周的上课节数条件
        $course_cond = [
            [
                'subj' => '历史',
                'limit' => 2
            ],
            [
                'subj' => '政治',
                'limit' => 4
            ],
            [
                'subj' => '语文',
                'limit' => 6
            ],
            [
                'subj' => '英语',
                'limit' => 20
            ],
        ];

        // 限制该学科本周的上课节数
        /*
          $result = $this->limitCourseNumber($course_cond);
          $tmp = [];
          $tn = 0; // 计数器
          for ($i = 0; $i < 8; $i++)
          {
          for ($j = 0; $j < 5; $j++)
          {
          $tmp[$i][$j]['course'] = $result[$tn]['course'];
          $tmp[$i][$j]['teacher'] = $result[$tn]['teacher'];
          $tn += 1;
          }
          }
          $result = $tmp;
         * 
         */

        // 限制该教师某一天的上课节数条件
        $teacher_cond = [
            [
                'teacher' => 't1',
                'limit' => 4,
                'day' => 1
            ],
            [
                'teacher' => 't6',
                'limit' => 1,
                'day' => 4
            ],
            [
                'teacher' => 't3',
                'limit' => 3,
                'day' => 1,
            ],
            [
                'teacher' => 't8',
                'limit' => 8,
                'day' => 2
            ]
        ];

        // 限制该教师某一天的上课节数
        $result = $this->limitTeacherNumber($teacher_cond);
//        dump($result);exit(0);
        return view('Home.Index.index', ['arrs' => $result]);
    }

    /**
     * 限制教师在某一天的上课节数
     * @param type $teacher_cond
     * @version 1.0.0.1215
     */
    public function limitTeacherNumber($teacher_cond = [])
    {
        $result = [];

        for ($i = 0; $i < 8; $i++)
        {
            for ($j = 0; $j < 5; $j++)
            {
                $result[$i][$j]['course'] = $this->subjects[array_rand($this->subjects)];
                $result[$i][$j]['teacher'] = $this->matchTeacherByCourse($result[$i][$j]['course']);
            }
        }

        foreach ($result as $rk => $rv)
        {
            foreach ($rv as $key => $val)
            {
                foreach ($teacher_cond as $k => $v)
                {
                    if ($v['day'] === ($key + 1)) {
                        for ($idx = 0; $idx < $v['limit']; $idx++)
                        {
                            $result[$idx][$key]['teacher'] = $v['teacher'];
                            $result[$idx][$key]['course'] = $this->getCourseByTeacher($v['teacher']);
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 根据教师查询对应的科目
     * @version 1.0.0.1215
     */
    public function getCourseByTeacher($teacher_name = '')
    {
        foreach ($this->teachers as $k => $v)
        {
            if ($v['name'] === $teacher_name) {
                return $v['subj'];
            }
        }
    }

    /**
     * 限制课程的节数
     * @param array $course_cond 限制排课条件
     */
    public function limitCourseNumber($course_cond = [])
    {
        // 根据条数生成固定数据
        // 然后生成缺少的数组
        // 数组组合
        // 打乱顺序
        $init_arr = [];
        $count = 0;
        $init_subj = [];
        $temp_arr = [];
        $course_pool = [];
        $result = [];
        foreach ($course_cond as $k => $v)
        {
            for ($i = 0; $i < $v['limit']; $i++)
            {
                array_push($init_arr, $v['subj']);
            }
            $count += $v['limit'];
            $init_subj[$k] = $v['subj'];
        }

        // 过滤掉指定学科
        $subjs = $this->filterSubject($init_subj);

        /**
         * @todo 判断lengh长度，确定是否需要生成数据
         */
        $length = 40 - $count;
        for ($i = 0; $i < $length; $i++)
        {
            $course_pool[$i]['course'] = $subjs[array_rand($subjs)];
            $course_pool[$i]['teacher'] = $this->matchTeacherByCourse($course_pool[$i]['course']);
        }
        foreach ($init_arr as $ik => $iv)
        {
            $temp_arr[$ik]['course'] = $iv;
            $temp_arr[$ik]['teacher'] = $this->matchTeacherByCourse($temp_arr[$ik]['course']);
        }

        // 数组合并
        $result = array_merge_recursive($temp_arr, $course_pool);

        // 随机组合
        shuffle($result);

        // 上午末节下午首节不能为同一个老师
        $result = $this->chkFirEnd($result);

        // 禁止科目相邻
        $result = $this->denyNearCourse($result);

        return $result;
    }

    /**
     * 禁止科目相邻
     * @version 1.0.0.1214
     */
    public function denyNearCourse($result = [])
    {
        foreach ($result as $k => $v)
        {
            
        }

        return $result;
    }

    /**
     * 上午末节下午首节不能为同一个老师
     * 递归运算
     * @param type $result
     * @param boolean $num
     * @return type
     * @version 1.0.0.1214
     */
    public function chkFirEnd($result = [])
    {
        if ($result[19]['course'] === $result[24]['course'] || $result[18]['course'] === $result[23]['course'] || $result[17]['course'] === $result[22]['course'] || $result[16]['course'] === $result[21]['course'] || $result[15]['course'] === $result[20]['course']) {
            shuffle($result);
            return $this->chkFirEnd($result);
        } else {
            return $result;
        }
    }

    /**
     * 过滤掉指定学科
     * @version 1.0.0.1214
     */
    public function filterSubject($subjs = [])
    {
        $subjects = $this->subjects;
        $arr = array_diff($subjects, $subjs);
        sort($arr);
        return $arr;
    }

    /**
     * 判断课程表中某课程的节数
     * @version 1.0.0.1213
     */
    public function getCourseTimes($course_name = '', $course_num = 0, $course_pool = [])
    {
        $temp_count = 0;
        foreach ($course_pool as $k => $v)
        {
            if ($v['course'] === $course_name) {
                $temp_count += 1;
            }
        }

        // 返回多出或者缺少的数据条数
        return ($temp_count > $course_num) ? ($temp_count - $course_num) : (($temp_count === $course_num) ? 0 : ($temp_count - $course_num));
    }

    /**
     * 根据科目匹配任教该科目的教师
     * @param string $course_name 课程名称
     * @version 1.0.0.1213
     */
    public function matchTeacherByCourse($course_name = '')
    {
        $teachers = $this->teachers;
        foreach ($teachers as $k => $v)
        {
            if ($v['subj'] === $course_name && $v['status'] === 1) {
                return $teachers[$k]['name'];
            }
        }
    }

}
