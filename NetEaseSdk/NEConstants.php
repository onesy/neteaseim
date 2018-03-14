<?php
namespace NetEaseSdk;

class NEConstants {
    const create_accid = "https://api.netease.im/nimserver/user/create.action";
    const update_accid = "https://api.netease.im/nimserver/user/update.action";
    const refresh_accid = "https://api.netease.im/nimserver/user/refreshToken.action";
    const block_accid = "https://api.netease.im/nimserver/user/block.action";
    const unblock_accid = "https://api.netease.im/nimserver/user/unblock.action";
    
    const update_accid_info = "https://api.netease.im/nimserver/user/updateUinfo.action";
    const get_accid_infos = "https://api.netease.im/nimserver/user/getUinfos.actio";
    
    const set_dunnop = "https://api.netease.im/nimserver/user/setDonnop.action";
    
    const add_friends = "https://api.netease.im/nimserver/friend/add.action";
    const update_friends = "https://api.netease.im/nimserver/friend/update.action";
    const delete_friends = "https://api.netease.im/nimserver/friend/delete.action";
    const get_friends = "https://api.netease.im/nimserver/friend/get.action";
    const quiet_black_friends = "https://api.netease.im/nimserver/user/setSpecialRelation.action";
    const quiet_black_friends_list = "https://api.netease.im/nimserver/user/listBlackAndMuteList.action";
    ############################################################single chat
    const send_msg = "https://api.netease.im/nimserver/msg/sendMsg.action";
    const batch_send_p2p_msg = "https://api.netease.im/nimserver/msg/sendBatchMsg.action";
    const self_define_sys_notify = "https://api.netease.im/nimserver/msg/sendAttachMsg.action";
    const batch_p2p_sys_notify = "https://api.netease.im/nimserver/msg/sendBatchAttachMsg.action";
    const file_upload = "https://api.netease.im/nimserver/msg/upload.action";
    const file_upload_multi = "https://api.netease.im/nimserver/msg/fileUpload.action";
    const recall = "https://api.netease.im/nimserver/msg/recall.action";
    const broadcast = "https://api.netease.im/nimserver/msg/broadcastMsg.action";
    ############################################################group chat
    const fund_group = "https://api.netease.im/nimserver/team/create.action";
    const add_sb_group = "https://api.netease.im/nimserver/team/add.action";
    const kick_out_group = "https://api.netease.im/nimserver/team/kick.action";
    const defund_group = "https://api.netease.im/nimserver/team/remove.action";
    const update_group_info = "https://api.netease.im/nimserver/team/update.action";
    const query_group_info = "https://api.netease.im/nimserver/team/query.action";
    const query_group_detail = "https://api.netease.im/nimserver/team/queryDetail.action";
    const change_owner = "https://api.netease.im/nimserver/team/changeOwner.action";
    const add_manager = "https://api.netease.im/nimserver/team/addManager.action";
    const remove_manager = "https://api.netease.im/nimserver/team/removeManager.action";
    const joined_teams = "https://api.netease.im/nimserver/team/joinTeams.action";
    const update_team_nick = "https://api.netease.im/nimserver/team/updateTeamNick.action";
    const mute_team = "https://api.netease.im/nimserver/team/muteTeam.action";
    const shut_up = "https://api.netease.im/nimserver/team/muteTlist.action";
    const quit_team = "https://api.netease.im/nimserver/team/leave.action";
    const shut_up_all_team = "https://api.netease.im/nimserver/team/muteTlistAll.action";
    const shut_up_list = "https://api.netease.im/nimserver/team/listTeamMute.action";
    ##############################################################chat root
    const fund_chat_root = "https://api.netease.im/nimserver/chatroom/create.action";
    const query_chat_root_info = "https://api.netease.im/nimserver/chatroom/get.action";
    const batch_query_chat_root_info = "https://api.netease.im/nimserver/chatroom/getBatch.action";
    const update_chat_root_info = "https://api.netease.im/nimserver/chatroom/update.action";
    const toggle_close_stat = "https://api.netease.im/nimserver/chatroom/toggleCloseStat.action";
    const set_member_role = "https://api.netease.im/nimserver/chatroom/setMemberRole.action";
    const request_address = "https://api.netease.im/nimserver/chatroom/requestAddr.action";
    const send_chat_root_msg = "https://api.netease.im/nimserver/chatroom/sendMsg.action";
    const add_robot = "https://api.netease.im/nimserver/chatroom/addRobot.action";
    const remove_robot = "https://api.netease.im/nimserver/chatroom/removeRobot.action";
    const temporary_shut_up = "https://api.netease.im/nimserver/chatroom/temporaryMute.action";
    const queue_offer = "https://api.netease.im/nimserver/chatroom/queueOffer.action";
    const queue_poll = "https://api.netease.im/nimserver/chatroom/queuePoll.action";
    const queue_list = "https://api.netease.im/nimserver/chatroom/queueList.action";
    const queue_drop = "https://api.netease.im/nimserver/chatroom/queueDrop.action";
    const queue_init = "https://api.netease.im/nimserver/chatroom/queueInit.action";
    const shut_up_one_room = "https://api.netease.im/nimserver/chatroom/muteRoom.action";
    const topn = "https://api.netease.im/nimserver/stats/chatroom/topn.action";
    const members_by_page = "https://api.netease.im/nimserver/chatroom/membersByPage.action";
    const query_members_online = "https://api.netease.im/nimserver/chatroom/queryMembers.action";
    const update_my_room_role = "https://api.netease.im/nimserver/chatroom/updateMyRoomRole.action";
    ##################################################################history
    // 单聊云端历史消息查询
    const history = "https://api.netease.im/nimserver/history/querySessionMsg.action";
    // 群聊云端历史消息查询
    const team_query_history = "https://api.netease.im/nimserver/history/queryTeamMsg.action";
    // 聊天室云端历史消息查询
    const root_query_history = "https://api.netease.im/nimserver/history/queryChatroomMsg.action";
    // 删除聊天室云端历史消息
    const delete_root_history = "https://api.netease.im/nimserver/chatroom/deleteHistoryMessage.action";
    // 用户登录登出事件记录查询
    const query_user_envent = "https://api.netease.im/nimserver/history/queryUserEvents.action";
    // 删除音视频/白板服务器录制文件
    const delete_media_file = "https://api.netease.im/nimserver/history/deleteMediaFile.action";
    // 批量查询广播消息
    const query_broadcast_msg = "https://api.netease.im/nimserver/history/queryBroadcastMsg.action";
    // 查询单条广播消息
    const query_broadcase_msg_by_id = "https://api.netease.im/nimserver/history/queryBroadcastMsgById.action";
    ###################################################################online status
    // 订阅在线状态事件
    const add_subscription = "https://api.netease.im/nimserver/event/subscribe/add.action";
    // 取消在线状态事件订阅
    const cancel_subscription = "https://api.netease.im/nimserver/event/subscribe/delete.action";
    // 取消全部在线状态事件订阅
    const cancel_all_subscription = "https://api.netease.im/nimserver/event/subscribe/batchdel.action";
    // 查询在线状态事件订阅关系
    const subscription_event_query = "https://api.netease.im/nimserver/event/subscribe/query.action";
    ###################################################################msg copy
}