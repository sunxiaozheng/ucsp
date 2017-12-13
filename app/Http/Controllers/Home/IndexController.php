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
        $course_cond = [
            [
                'subj' => '历史',
                'limit' => 4
            ],
            [
                'subj' => '政治',
                'limit' => 2
            ],
            [
                'subj' => '语文',
                'limit' => 8
            ],
            [
                'subj' => '英语',
                'limit' => 6
            ],
        ];
        $result = $this->limitCourseNumber($course_cond, $course_pool);

        return view('Home.Index.index', ['arrs' => $result]);
    }

    /**
     * 限制课程的节数
     * @param array $course_cond 限制排课条件
     */
    public function limitCourseNumber($course_cond = [], $course_pool = [])
    {
        // 判断每个限制条件
        foreach ($course_cond as $ck => $cv)
        {
            $course_cond[$ck]['cha'] = $this->getCourseTimes($cv['subj'], $cv['limit'], $course_pool);
        }


        foreach ($course_cond as $key => $value)
        {
            $temp_count = 0;
            $t_arr = [];
            $temp_subjects = $t_arr ?: $this->subjects;

            // 多出的数据条数
            if ($course_cond[$key]['cha'] > 0) {
                $temp_count = $value['cha'];

                foreach ($course_pool as $k => $v)
                {
                    if ($v['course'] === $value['subj'] && $temp_count > 0) {
                        foreach ($temp_subjects as $tsk => $tsv)
                        {
                            if ($tsv === $value['subj']) {
                                unset($temp_subjects[$tsk]);
                            }
                        }
                        sort($temp_subjects);

                        $t_arr = $temp_subjects;
                        $course_pool[$k]['course'] = $temp_subjects[array_rand($temp_subjects)];
                        $course_pool[$k]['teacher'] = $this->matchTeacherByCourse($course_pool[$k]['course']);

                        $temp_count -= 1;
                    } else {
                        continue;
                    }
                }
            }
        }

        foreach ($course_cond as $key => $value)
        {
            $temp_count = 0;

            // 缺少的数据条数
            if ($course_cond[$key]['cha'] < 0) {
                $temp_count = abs($value['cha']);
                foreach ($course_pool as $k => $v)
                {
                    if ($v['course'] !== $value['subj'] && $temp_count > 0) {
                        $course_pool[$k]['course'] = $value['subj'];
                        $course_pool[$k]['teacher'] = $this->matchTeacherByCourse($course_pool[$k]['course']);
                        $temp_count -= 1;
                    } else {
                        continue;
                    }
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
