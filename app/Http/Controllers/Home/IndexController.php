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

    /**
     * 初始化数据
     * @version 1.0.0.1220
     */
    public function __construct()
    {
        // 所有的学科
        $this->subjects = ['语文', '数学', '英语', '物理', '化学', '生物', '历史', '地理', '政治'];

        // 教师列表
        $this->teachers = [
            [
                'name' => 't1',
                'subj' => $this->subjects[0]
            ],
            [
                'name' => 't2',
                'subj' => $this->subjects[1]
            ],
            [
                'name' => 't3',
                'subj' => $this->subjects[2]
            ],
            [
                'name' => 't4',
                'subj' => $this->subjects[3]
            ],
            [
                'name' => 't5',
                'subj' => $this->subjects[4]
            ],
            [
                'name' => 't6',
                'subj' => $this->subjects[5]
            ],
            [
                'name' => 't7',
                'subj' => $this->subjects[6]
            ],
            [
                'name' => 't8',
                'subj' => $this->subjects[7]
            ],
            [
                'name' => 't9',
                'subj' => $this->subjects[8]
            ],
        ];
    }

    /**
     * 程序入口
     * @version 1.0.0.1221
     */
    public function index()
    {
        // 生成一个 5*8 的课程表
        $course_table = $this->crtCourseTable(5, 8);
        return view('Home.Index.index', ['lists' => $course_table]);
    }

    /**
     * 生成课程表
     * @param int $day 每周上课天数
     * @param int $section 每天上课节数
     * @version 1.0.0.1215
     */
    public function crtCourseTable($day = 5, $section = 8)
    {
        $course_table = [];

        for ($i = 0; $i < $section; $i++)
        {
            for ($j = 0; $j < $day; $j++)
            {
                $course_table[$i][$j]['course'] = $this->subjects[array_rand($this->subjects)];
                $course_table[$i][$j]['teacher'] = $this->getTeacherNameByCourse($course_table[$i][$j]['course']);
            }
        }

        return $course_table;
    }

    /**
     * 限制学科在本周的上课节数
     * @route lmtcoursebysubj
     * @version 1.0.0.1220
     */
    public function limitCourseBySubject()
    {
        // 生成课表
        $course_table = $this->crtCourseTable();

        // 根据科目限制
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

        // 根据限制条件返回数据表
        $course_data = $this->limitNumByCourse($course_cond, $course_table);

        // 转换展示形式
        $idx = 0;       // 指针
        $temp_arr = []; // 临时数组
        for ($i = 0; $i < 8; $i++)
        {
            for ($j = 0; $j < 5; $j++)
            {
                $temp_arr[$i][$j]['course'] = $course_data[$idx]['course'];
                $temp_arr[$i][$j]['teacher'] = $course_data[$idx]['teacher'];
                $idx += 1;
            }
        }

        $result = $temp_arr; // 赋值
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 根据科目限制课程本周的上课节数
     * @param array $course_cond 限制排课条件
     * @param array $course_table 课表
     * @version 1.0.0.1214
     */
    public function limitNumByCourse($course_cond = [], $course_table = [])
    {
        $temp_table = []; // 临时用来放置限制条件
        $temp_count = 0; // 限制条件中科目的总节数
        $temp_subj = []; // 限制条件中所有的科目
        $course_table_count = 0; // 存放课表总数据数
        $limit_course_table = []; // 存放限制条件数组
        $course_temp_table = []; // 存放剩余可创建的学科数据
        // 创建一个限制条件组成的数组
        foreach ($course_cond as $k => $v)
        {
            for ($i = 0; $i < $v['limit']; $i++)
            {
                array_push($temp_table, $v['subj']);
            }
            $temp_count += $v['limit'];
            $temp_subj[$k] = $v['subj'];
        }

        // 从所有学科中过滤掉限制条件中的学科
        $canCrtSubjs = $this->filterSubject($temp_subj);

        // 获取课表数据条数
        for ($m = 0; $m < count($course_table); $m++)
        {
            for ($n = 0; $n < count($course_table[$m]); $n++)
            {
                $course_table_count = ($m + 1) * ($n + 1);
            }
        }

        // 剩余可创建的数据条数
        $crt_count = $course_table_count - $temp_count;
        for ($j = 0; $j < $crt_count; $j++)
        {
            $course_temp_table[$j]['course'] = $canCrtSubjs[array_rand($canCrtSubjs)];
            $course_temp_table[$j]['teacher'] = $this->getTeacherNameByCourse($course_temp_table[$j]['course']);
        }

        // 处理限制条件构成数据
        foreach ($temp_table as $ik => $iv)
        {
            $limit_course_table[$ik]['course'] = $iv;
            $limit_course_table[$ik]['teacher'] = $this->getTeacherNameByCourse($limit_course_table[$ik]['course']);
        }

        // 合并限制条件数据和过滤后的学科数据
        $final_course_table = array_merge_recursive($limit_course_table, $course_temp_table);

        // 变乱数组
        shuffle($final_course_table);

        return $final_course_table;
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
     * 限制教师当天的上课节数
     * @route lmttechdailycoursenum
     * @version 1.0.0.1220
     */
    public function limitTeacherDailyCourseNumber()
    {
        // 限制教师当天上课节数条件
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
                'teacher' => 't2',
                'limit' => 1,
                'day' => 1
            ],
            [
                'teacher' => 't3',
                'limit' => 1,
                'day' => 1,
            ],
            [
                'teacher' => 't8',
                'limit' => 8,
                'day' => 2
            ]
        ];

        // 限制该教师某一天的上课节数
        $result = $this->limitTeacherCourseNumber($teacher_cond);
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 限制教师在某一天的上课节数
     * @param array $teacher_cond 限制教师当天上课节数条件
     * @version 1.0.0.1215
     */
    public function limitTeacherCourseNumber($teacher_cond = [])
    {
        $course_table = $this->crtCourseTable();

        // 计算出需要处理数据的天数
        $temp_days = [];
        foreach ($teacher_cond as $ck => $cv)
        {
            $temp_days[] = $cv['day'];
        }
        $days = array_unique($temp_days);
        sort($days);

        // 整理出每天的上课总节数
        $final_cond = [];
        foreach ($days as $dk => $dv)
        {
            $teacher_data = []; // 存放教师信息
            $final_cond[$dk]['class_num'] = 0; // 节次
            foreach ($teacher_cond as $tk => $tv)
            {
                if ($tv['day'] === $dv) {
                    $final_cond[$dk]['day'] = $dv;
                    $final_cond[$dk]['class_num'] += $tv['limit'];
                    for ($i = 0; $i < $tv['limit']; $i++)
                    {
                        array_push($teacher_data, $tv['teacher']);
                    }
                    $final_cond[$dk]['data'] = $teacher_data;
                    $final_cond[$dk]['course'][] = $this->getCourseByTeacher($tv['teacher']);
                }
            }
        }

        // 组织数据格式
        $final_data = [];
        foreach ($final_cond as $k => $v)
        {
            $final_data[$v['day']] = [
                'class_num' => $v['class_num'], // 每天对应的课程节数
                'tech_data' => $v['data'], // 教师数据
                'course_list' => array_unique($v['course'])
            ];
        }

        foreach ($teacher_cond as $k => $v)
        {
            for ($i = 0; $i < count($course_table); $i++)
            {
                for ($j = 0; $j < count($course_table[$i]); $j++)
                {
                    if ($v['day'] === $j) {
                        for ($idx = 0; $idx < $final_data[$v['day']]['class_num']; $idx++)
                        {
                            $course_table[$idx][$j - 1]['teacher'] = $final_data[$v['day']]['tech_data'][$idx];
                            $course_table[$idx][$j - 1]['course'] = $this->getCourseByTeacher($final_data[$v['day']]['tech_data'][$idx]);
                        }

                        for ($idx = 0; $idx < count($course_table) - $final_data[$v['day']]['class_num']; $idx++)
                        {
                            // 排除掉每一天的任课信息
                            $temp_subjs = $this->filterSubject($final_data[$v['day']]['course_list']);
                            $course_table[$final_data[$v['day']]['class_num'] + $idx][$j - 1]['course'] = $temp_subjs[array_rand($temp_subjs)];
                            $course_table[$final_data[$v['day']]['class_num'] + $idx][$j - 1]['teacher'] = $this->getTeacherNameByCourse($temp_subjs[array_rand($temp_subjs)]);
                        }
                    }
                }
            }
        }

        return $course_table;
    }

    /**
     * 科目互斥
     * @route chksubjmutex
     * @version 1.0.0.1221
     */
    public function chkSubjectMutex()
    {
        // 科目互斥条件
        $subj_mutex = [
            [
                'one' => '语文',
                'two' => '数学',
                'day' => 1
            ],
            [
                'one' => '语文',
                'two' => '英语',
                'day' => 2
            ],
            [
                'one' => '英语',
                'two' => '数学',
                'day' => 3
            ],
            [
                'one' => '政治',
                'two' => '地理',
                'day' => 5
            ]
        ];

        // 检测科目互斥
        $result = $this->chkSubjMutex($subj_mutex);
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 科目互斥功能
     * 学科A与学科B不排在同一天
     * @version 1.0.0.1215
     */
    public function chkSubjMutex($subj_mutex = [])
    {
        // 生成课表
        $course_table = $this->crtCourseTable();

        $has_one = 0;
        $has_two = 0;

        foreach ($subj_mutex as $sk => $sv)
        {
            for ($i = 0; $i < count($course_table); $i++)
            {
                for ($j = 0; $j < count($course_table[$i]); $j++)
                {
                    if ($sv['day'] === $j) {
                        // 当天包含第一节
                        if ($course_table[$i][$j - 1]['course'] === $sv['one']) {
                            $has_one = 1;
                        }

                        // 当天包含第二节
                        if ($course_table[$i][$j - 1]['course'] === $sv['two']) {
                            $has_two = 1;
                        }
                    }
                }
            }
        }

        $total = $has_one + $has_two;
        if ($total > 1) {
            return $this->chkSubjMutex($subj_mutex);
        }

        return $course_table;
    }

    /**
     * 禁止科目相邻
     * @route coursenotnextto
     * @version 1.0.0.1221
     */
    public function courseNotNextTo()
    {
        // 禁止科目相邻条件
        $course_cond = [
            [
                'front' => '语文',
                'behind' => '数学'
            ],
            [
                'front' => '英语',
                'behind' => '化学',
            ],
            [
                'front' => '历史',
                'behind' => '政治',
            ]
        ];


        // 检测科目相邻
        $result = $this->notNextTo($course_cond);
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 科目A不排于科目B前面
     * @version 1.0.0.1216
     */
    public function notNextTo($course_cond = [])
    {
        // 生成课表
        $course_table = $this->crtCourseTable();

        foreach ($course_cond as $k => $v)
        {
            for ($i = 0; $i < count($course_table); $i++)
            {
                for ($j = 0; $j < count($course_table[$i]); $j++)
                {
                    // 防止下标越界
                    if ($i < 7) {
                        // 第一个条件成立
                        if ($course_table[$i][$j]['course'] === $v['front']) {
                            // 第二个条件成立
                            if ($course_table[$i + 1][$j]['course'] === $v['behind']) {
                                // 递归
                                return $this->notNextTo($course_cond);
                            }
                        }
                    }
                }
            }
        }

        return $course_table;
    }

    /**
     * 教师当天的课分散排列
     * @route coursediv
     * @version 1.0.0.1221
     */
    public function courseDevide()
    {
        // 教师列表
        $teacher_arr = ['t1', 't3', 't2'];

        // 处理教师课表
        $result = $this->teacherCourseDevide($teacher_arr);
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 尽量让他当天上下午都有课
     * @param array $teacher_arr 教师列表
     * @version 1.0.0.1218
     */
    public function teacherCourseDevide($teacher_arr = [])
    {
        // 生成课表
        $course_table = $this->crtCourseTable();

        // 转换课表样式
        $temp_course_table = [];
        for ($i = 0; $i < count($course_table); $i++)
        {
            for ($j = 0; $j < count($course_table[$i]); $j++)
            {
                $temp_course_table[$j][$i] = $course_table[$i][$j];
            }
        }

        $temp_day_arr = []; // 存放上午和下午数据
        $day_div = intval(count($temp_course_table[0]) / 2); // 切割上下午

        foreach ($temp_course_table as $k => $v)
        {
            for ($t = 0; $t < count($teacher_arr); $t++)
            {
                // 初始化
                $temp_day_arr[$k][$t]['am'] = $temp_day_arr[$k][$t]['pm'] = 0;
                $temp_day_arr[$k][$t]['teacher'] = $teacher_arr[$t];
                foreach ($v as $vk => $vv)
                {
                    if ($vk < $day_div) {
                        if (in_array($teacher_arr[$t], $temp_course_table[$k][$vk])) {
                            $temp_day_arr[$k][$t]['am'] = 1;
                        }
                    } else {
                        if (in_array($teacher_arr[$t], $temp_course_table[$k][$vk])) {
                            $temp_day_arr[$k][$t]['pm'] = 1;
                        }
                    }
                }
            }
        }

        for ($m = 0; $m < count($temp_course_table); $m++)
        {
            for ($n = 0; $n < count($temp_course_table[$m]); $n++)
            {
                for ($z = 0; $z < count($temp_day_arr[$m]); $z++)
                {
                    if ($temp_day_arr[$m][$z]['am'] === 0) {
                        $temp_course_table[$m][$z]['teacher'] = $temp_day_arr[$m][$z]['teacher'];
                        $temp_course_table[$m][$z]['course'] = $this->getCourseByTeacher($temp_day_arr[$m][$z]['teacher']);
                    }

                    if ($temp_day_arr[$m][$z]['pm'] === 0) {
                        $temp_course_table[$m][$day_div + $z]['teacher'] = $temp_day_arr[$m][$z]['teacher'];
                        $temp_course_table[$m][$day_div + $z]['course'] = $this->getCourseByTeacher($temp_day_arr[$m][$z]['teacher']);
                    }
                }
            }
        }

        // 转换为原来的数据格式
        $result = [];
        for ($i = 0; $i < count($temp_course_table); $i++)
        {
            for ($j = 0; $j < count($temp_course_table[$i]); $j++)
            {
                $result[$j][$i] = $temp_course_table[$i][$j];
            }
        }

        return $result;
    }

    /**
     * 上午末节下午首节不能为同一个老师
     * @route amnotnexttopm
     * @version 1.0.0.1221
     */
    public function amNotNextToPm()
    {
        $course_table = $this->crtCourseTable();

        $day_div = intval(count($course_table) / 2); // 切割上下午

        for ($i = 0; $i < count($course_table); $i++)
        {
            for ($j = 0; $j < count($course_table[$i]); $j++)
            {
                if ($course_table[$day_div - 1][$j]['teacher'] === $course_table[$day_div][$j]['teacher']) {
                    return $this->amNotNextToPm();
                }
            }
        }

        // 赋值
        $result = $course_table;
        return view('Home.Index.index', ['lists' => $result]);
    }

    /**
     * 根据教师查询对应的任课科目
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
     * 根据科目获取任课教师名称
     * @param string $course_name 课程名称
     * @version 1.0.0.1213
     */
    public function getTeacherNameByCourse($course_name = '')
    {
        $teacher_list = $this->teachers;
        foreach ($teacher_list as $k => $v)
        {
            if ($v['subj'] === $course_name) {
                return $teacher_list[$k]['name'];
            }
        }
    }

}
