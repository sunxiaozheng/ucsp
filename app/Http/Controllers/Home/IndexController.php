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
        /*
         * 课程池
         */
        $course_pool = [];
        $subjects = $this->subjects;

        for ($i = 0; $i < 40; $i++)
        {
            $course_pool[$i]['course'] = $subjects[array_rand($subjects)];
            $course_pool[$i]['teacher'] = $this->matchTeacherByCourse($course_pool[$i]['course']);
        }

        // 限制条件
        $result = $this->limitCourseNumber('历史', 4, $course_pool);
        
        return view('Home.Index.index', ['arrs' => $result]);
    }

    /**
     * 限制课程的节数
     * @param type $course_name
     * @param type $course_num
     */
    public function limitCourseNumber($course_name = '', $course_num = 0, $course_pool = [])
    {
        $cha = $this->getCourseTimes($course_name, $course_num, $course_pool);

        // 多出的数据条数
        if ($cha > 0) {
            $temp_count = $cha;
            foreach ($course_pool as $k => $v)
            {
                if ($v['course'] === $course_name && $temp_count > 0) {
                    $temp_subjects = $this->subjects;
                    foreach ($temp_subjects as $tsk => $tsv)
                    {
                        if ($tsv === $course_name) {
                            unset($temp_subjects[$tsk]);
                        }
                    }
                    sort($temp_subjects);

                    $course_pool[$k]['course'] = $temp_subjects[array_rand($temp_subjects)];
                    $course_pool[$k]['teacher'] = $this->matchTeacherByCourse($course_pool[$k]['course']);
                    $temp_count -= 1;
                } else {
                    continue;
                }
            }
        }

        // 缺少的数据条数
        if ($cha < 0) {
            $temp_count = abs($cha);
            foreach ($course_pool as $k => $v)
            {
                if ($v['course'] !== $course_name && $temp_count > 0) {
                    $course_pool[$k]['course'] = $course_name;
                    $course_pool[$k]['teacher'] = $this->matchTeacherByCourse($course_pool[$k]['course']);
                    $temp_count -= 1;
                } else {
                    continue;
                }
            }
        }

        return $course_pool;
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
